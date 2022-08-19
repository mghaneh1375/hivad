<?php

namespace App\Http\Controllers;


use App\models\SlideBar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Intervention\Image\ImageManagerStatic as Image;

class SlideController extends Controller {

    public function manageSlideShow() {
        return view('admin.slides', ['slides' => SlideBar::all()]);
    }

    public function remove(SlideBar $slidebar) {

        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $slidebar->image . '.jpg'))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $slidebar->image . '.jpg');
        
        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $slidebar->image . '.jpg'))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/thumb/' . $slidebar->image . '.jpg');

        $slidebar->delete();
        return response()->json(["status" => "ok"]);

    }

    public function update(SlideBar $slidebar = null, Request $request) {

        if($slidebar == null)
            return response()->json(["status" => "nok"]);
        
        $request->validate([
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'header' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'visibility' => 'required|boolean'
        ]);

        $slidebar->priority = $request->priority;
        $slidebar->visibility = $request->visibility;
        $slidebar->alt = $request->has('alt') ? $request->alt : $slidebar->alt;
        $slidebar->header = $request->has('header') ? $request->header : $slidebar->header;
        $slidebar->description = $request->has('description') ? $request->description : $slidebar->description;

        $slidebar->save();

        return response()->json(["status" => "ok"]);
    }


    public function store(Request $request) {
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'header' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1'
        ]);

        $image       = $request->file('image');
        $filename    = time() . '.jpg';
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename));              
        $image_resize->resize(150, 150);
        $image_resize->save(public_path('Content/images/GalleryPictures/thumb/' . $filename));

        $filename = str_replace('.jpg', '', $filename);

        SlideBar::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'header' => $request->has('header') ? $request['header'] : null,
            'description' => $request->has('description') ? $request['description'] : null,
        ]);

        return Redirect::route('manageSlideShow');
    }
}
