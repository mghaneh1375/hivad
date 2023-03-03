<?php

namespace App\Http\Controllers;

use App\Models\Cafe;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class CafeController extends Controller
{
    
    public function manageCafe() {
        $about = Config::first()->cafe;
        $all_cafe_items = Cafe::all();
        return view('admin.cafe', compact('about', 'all_cafe_items'));
    }

    public function setAboutCafe(Request $request) {

        $request->validate([
            'text' => 'required|string|min:1'
        ]);

        $config = Config::first();
        $config->cafe = $request->text;

        $config->save();
        return response()->json(["status" => "ok"]);
    }

    public function remove(Cafe $cafe = null) {

        if($cafe == null)
            return abort(401);

        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $cafe->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $cafe->image);
        
        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $cafe->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $cafe->image);

        $cafe->delete();
        return response()->json(["status" => "ok"]);
    }

    public function update(Cafe $cafe = null, Request $request) {

        if($cafe == null)
            return response()->json(["status" => "nok"]);
        
        $request->validate([
            'priority' => 'required|int|min:1',
            'visibility' => 'nullable|boolean',
            'alt' => 'nullable|string|min:1'
        ]);

        $cafe->visibility = $request->has('visibility') ? $request['visibility'] : $cafe->visibility;
        $cafe->priority = $request->priority;
        $cafe->alt = $request->has('alt') ? $request->alt : $cafe->alt;
        $cafe->save();

        return response()->json(["status" => "ok"]);
    }

    public function store(Request $request) {

        $request->validate([
            'image' => 'required|image',
            'alt' => 'nullable|string|min:1',
            'priority' => 'required|integer|min:1'
        ]);
        
        $image       = $request->file('image');
        
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename));              
        $image_resize->resize(150, 150);
        $image_resize->save(public_path('Content/images/GalleryPictures/thumb/' . $filename));

        Cafe::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority']
        ]);

        return Redirect::route('manageCafe');
    }
}
