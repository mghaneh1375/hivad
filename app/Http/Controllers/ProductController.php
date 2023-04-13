<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductAdminDigest;
use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController extends Controller
{

    public function report(Request $request)
    {
        $items = 
            Transaction::complete()->with(['user', 'product'])->orderBy('id', 'desc')->get();

        return view('admin.report', [
            'items' => TransactionResource::collection($items)->toArray($request)
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    
    public function manageProducts(Request $request) {
        return view('admin.Product.list', [
            'allProducts' => ProductAdminDigest::collection(Product::all())->toArray($request)
        ]);
    }


    public function remove(Product $product) {

        if(file_exists(__DIR__ . '/../../../public/Content/images/products/crop/' . $product->image))
            unlink(__DIR__ . '/../../../public/Content/images/products/crop/' . $product->image);

        if(file_exists(__DIR__ . '/../../../public/Content/images/products/crop/' . $product->file))
            unlink(__DIR__ . '/../../../public/Content/images/products/crop/' . $product->file);

        $product->delete();
        return response()->json(["status" => "ok"]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'file' => 'required|file',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'keywords' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'digest' => 'nullable|string|min:1',
            'price' => 'required|integer|min:0',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean',
        ]);

        $image       = $request->file('image');
        
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/products/crop/' . $filename));

        
        $file       = $request->file('file');
        $file_filename = $file->store('products/crop');
        $file_filename = str_replace('products/crop/', '', $file_filename);

        Product::create([
            'digest' => $request->digest,
            'image' => $filename,
            'file' => $file_filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'keywords' => $request->has('keywords') ? $request['keywords'] : null,
            'description' => $request->has('description') ? $request['description'] : null,
            'priority' => $request['priority'],
            'title' => $request['title'],
            'price' => $request['price'],
            'is_imp' => $request['is_imp'],
        ]);

        return Redirect::route('manageProducts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function payment(Request $request, Product $product)
    {
        $userId = $request->user()->id;

        $t = Transaction::where('user_id', $userId)->where('product_id', $product->id)->complete()->first();
        if($t != null) {
            return Redirect::route('failed', ['err' => 'duplicate']);
        }
        
        $response = zarinpal()
            ->amount($product->price * 10) // مبلغ تراکنش
            ->merchantId('c9b8f4e9-94d2-4d46-97bb-483452991e01')
            ->request()
            ->description($product->id) // توضیحات تراکنش
            ->callbackUrl('http://hivadkids.ir/verification') // آدرس برگشت پس از پرداخت
            ->mobile('09038180329')
            ->send();

        if (!$response->success()) {
            return $response->error()->message();
        }

        dd($response->authority);

        $t = random_int(100000, 999999);
        while(Transaction::where('tracking_code', $t)->count() > 0)
            $t = random_int(100000, 999999);

        $t = Transaction::create([
            'user_id' => $userId,
            'product_id' => $product->id,
            'amount' => $product->price * 10,
            'tracking_code' => $t,
            'additional_id' => $response['authority']
        ]);


        return $response->redirect();
    }

    public function verification(Request $request)
    {
        $authority = $request->query('Authority'); // دریافت کوئری استرینگ ارسال شده توسط زرین پال
        $status = $request->query('Status', null); // دریافت کوئری استرینگ ارسال شده توسط زرین پال

        if($status != null && strtolower($status) == "ok") {
            
            $t = Transaction::orderBy('id', 'desc')->first();
            if($t == null)
                return abort(401);

            $response = zarinpal()
                ->merchantId('c9b8f4e9-94d2-4d46-97bb-483452991e01')
                ->amount($t->amount)
                ->verification()
                ->authority($authority)
                ->send();

            if (!$response->success()) {
                return $response->error()->message();
            }

            $t->status = Transaction::COMPLETE;
            $t->ref_num = $response->referenceId();
            $t->save();

            Auth::loginUsingId($t->user_id);

            return Redirect::route('success', 
                ['transaction' => $t]
            );
        }

        return Redirect::route('');

    }

    public function success(Request $request, Transaction $transaction) {
        
        $userId = $request->user()->id;

        if($transaction->user_id != $userId || $transaction->status != Transaction::COMPLETE)
            return abort(401);

        $product = $transaction->product->title;

        return view('success', ['transaction' => $transaction, 'product' => $product]);
    }
    
    public function failed($err, Transaction $transaction = null) {
        
        if($transaction != null && $transaction->status == Transaction::COMPLETE)
            return abort(401);

        $product = $transaction->product->title;

        return view('fail', ['amount' => $transaction, 'product' => $product]);
    }
}
