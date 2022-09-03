<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleGalleryJSON;
use App\models\Category;
use App\models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends RenderController
{

    public function manageGallery()
    {
        return view('admin.gallery', ['galleries' => Gallery::all()]);
    }

    public function remove(Gallery $gallery)
    {

        if (file_exists(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $gallery->image . '.jpg'))
            unlink(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $gallery->image . '.jpg');

        $gallery->delete();
        return response()->json(["status" => "ok"]);
    }

    public function list(Request $request)
    {
        $category = Category::whereId($request->query('albumID'))->first();
        $galleries = Gallery::whereCatId($category->id)->where('visibility', true)->get();
        return json_encode(
            [
                "boxID" => 38888,
                "isVideo" => false,
                "isFileGallery" => false,
                "model" => [
                    "GalleryList" => SingleGalleryJSON::collection($galleries),
                    "AlbumList" => null,
                    "BoxCountPerRow" => 3,
                    "SubBoxHeight" => 250,
                    "paddingBottom" => 0,
                    "boxID" => 38888
                ],
                "top" => 100,
                "Pagination" => 3,
                "ShowMoreLink" => null
            ]
        );
    }

    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ]);

        $image       = $request->file('image');
        $filename    = time() . '.jpg';

        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/shortcutTab/' . $filename));

        $filename = str_replace('.jpg', '', $filename);

        Gallery::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'title' => $request->has('title') ? $request['title'] : null,
            'is_imp' => $request['is_imp'],
        ]);

        return Redirect::route('manageGallery');
    }

    public function update(Gallery $gallery = null, Request $request)
    {

        if ($gallery == null)
            return response()->json(["status" => "nok"]);

        $request->validate([
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean',
            'visibility' => 'required|boolean'
        ]);

        $gallery->priority = $request->priority;
        $gallery->visibility = $request->visibility;
        $gallery->alt = $request->has('alt') ? $request->alt : $gallery->alt;
        $gallery->title = $request->has('title') ? $request->title : $gallery->title;
        $gallery->is_imp = $request->is_imp;

        $gallery->save();

        return response()->json(["status" => "ok"]);
    }


    public function gallery()
    {

        $pics = DB::select('select g.*, c.name as categoryName from category c, gallery g where g.category = c.id');

        foreach ($pics as $pic) {
            $pic->name = URL::asset('gallery/' . $pic->name);
        }

        $categories = Category::all();

        return view('admin.gallery', ['pics' => $pics, 'categories' => $categories]);
    }
}
