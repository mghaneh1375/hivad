<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Introduce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class IntroduceController extends Controller
{
    
    public function manageIntroduce() {
        $about = Config::first()->about;
        $introduces = Introduce::all();
        return view('admin.introduce', compact('about', 'introduces'));
    }

    public function setAboutUs(Request $request) {

        $request->validate([
            'text' => 'required|string|min:1'
        ]);

        $config = Config::first();
        $config->about = $request->text;

        $config->save();
        return response()->json(["status" => "ok"]);
    }
    
    public function remove(Introduce $introduce = null) {

        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $introduce->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $introduce->image);
        
        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $introduce->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $introduce->image);

        $introduce->delete();
        return response()->json(["status" => "ok"]);
    }

    public function update(Introduce $introduce = null, Request $request) {

        if($introduce == null)
            return response()->json(["status" => "nok"]);
        
        $request->validate([
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1'
        ]);

        $introduce->priority = $request->priority;
        $introduce->alt = $request->has('alt') ? $request->alt : $introduce->alt;
        $introduce->save();

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

        Introduce::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority']
        ]);

        return Redirect::route('manageIntroduce');
    }

}
