<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\Category;
use App\Models\Msg;
use App\Models\User;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends RenderController {

    public function get_json_file() {   
        return json_encode($this->json_file());
    }

    public function news_get_json_file() {
        return json_encode($this->news_json_file());
    }

    public function shop_get_json_file() {
        return json_encode($this->shop_json_file());
    }
    
    public function my_products_get_json_file(Request $request) {
        return json_encode($this->my_products_json_file($request));
    }
    
    public function article_get_json_file() {
        return json_encode($this->article_json_file());
    }

    public function cafe_get_json_file() {
        return json_encode($this->about_cafe_json_file());
    }
    
    public function people_get_json_file() {
        return json_encode($this->people_json_file());
    }

    public function spec_articles_get_json_file(Category $category) {
        return json_encode($this->spec_articles_json_file($category));
    }
    
    public function spec_category_get_json_file(Category $category) {
        return json_encode($this->spec_category_json_file($category));
    }

    public function galleries_get_json_file() {
        return json_encode($this->galleries_json_file());
    }
    
    public function videos_get_json_file() {
        return json_encode($this->videos_json_file());
    }

    public function contact_get_json_file() {
        return json_encode($this->contact_json_file());
    }

    public function survey_get_json_file() {
        return json_encode($this->survey_json_file());
    }
    
    public function advice_request_get_json_file() {
        return json_encode($this->advice_request_json_file());
    }

    public function panel() {
        return view('admin.panel');
    }

    public function uploadImg(Request $request) {

        $request->validate([
            'upload' => 'required|image'
        ]);

        $image       = $request->file('upload');
        $img = $request->file('upload')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/tmp/' . $filename));

        return response()->json(['status' => 'ok', 'url' => asset('Content/images/tmp/' . $filename)]);
    }

    // public function login() {

    //     if(Auth::check())
    //         return Redirect::route('home');

    //     return view('login2', ['msg' => '']);
    // }

    // public function doLogin() {

    //     if(myPostIsset(["username"]) && myPostIsset(["password"])) {

    //         $username = makeValidInput($_POST["username"]);
    //         $password = makeValidInput($_POST["password"]);

    //         if(Auth::attempt(['username' => $username, 'password' => $password], true)) {

    //             if(!Auth::user()->status) {
    //                 Auth::logout();
    //                 Session::flush();
    //                 return view('login', ['msg' => 'حساب کاربری شما فعال نیست']);
    //             }

    //             return Redirect::route('home');
    //         }

    //         return view('login', ['msg' => 'نام کاربری یا رمز عبور را اشتباه وارد کرده اید']);
    //     }

    //     return view('login', ['msg' => '']);
    // }

    // public function doChangePass() {

    //     if(isset($_POST["oldPass"]) && isset($_POST["newPass"]) &&
    //         isset($_POST["confirmPass"])
    //     ) {

    //         $user = Auth::user();

    //         $oldPass = $_POST["oldPass"];
    //         $newPass = $_POST["newPass"];
    //         $confirmPass = $_POST["confirmPass"];

    //         if($newPass == $confirmPass) {

    //             if (Hash::check($oldPass, $user->password)) {
    //                 $user->password = Hash::make($newPass);
    //                 $user->save();
    //                 echo "ok";
    //             }
    //             else
    //                 echo "nok2";

    //             return;
    //         }
    //         else {
    //             echo "nok1";
    //         }

    //     }

    // }

    // public function logout() {
    //     Auth::logout();
    //     Session::flush();
    //     return Redirect::route('home');
    // }

    // public function changePass() {
    //     return view('changePass');
    // }

    public function submitForm(Request $request) {

        $formID = $request->query('formID');
        if($formID == 8420) {
            $request->validate([
                'filedValue_name' => 'required|string|min:2',
                'filedValue_mail' => 'nullable|email',
                'filedValue_phone' => 'required|regex:/(09)[0-9]{9}/',
                'filedValue_title' => 'required|string|min:2',
                'filedValue_msg' => 'required|string|min:2'
            ]);

            $msg = new Msg();
            $msg->name = $request['filedValue_name'];
            $msg->mail = $request['filedValue_mail'];
            $msg->phone = $request['filedValue_phone'];
            $msg->title = $request['filedValue_title'];
            $msg->msg = $request['filedValue_msg'];

            $msg->save();
            return response()->json(['status' => 'ok', 'sunccess' => true, 'logID' => 1, 'message' => 'فرم شما با موفقیت ثبت گردید.']);
        }
        else if($formID == "survey" || $formID == "advice") {
            return AdviceFormController::submit($request, $formID);
        }
    }

    public function msgs(Request $request) {
        
        $seen = $request->query('seen');
        if($seen != null && $seen == 'false')
            $msgs = Msg::unSeen()->orderBy('id', 'desc')->get();
        else
            $msgs = Msg::orderBy('id', 'desc')->get();

        DB::update('update msg set seen = true where seen = false');

        return view('admin.msgs', ['msgs' => $msgs]);
    }

    public function removeMsg(Msg $msg) {
        $msg->delete();
        return response()->json(['status' => 'ok']);
    }

}
