<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleGalleryJSON;
use App\models\Article;
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
        return view('admin.gallery', [
            'galleries' => Gallery::all(),
            'categories' => Category::where('section', 'gallery')->get()
        ]);
    }

    public function remove(Gallery $gallery)
    {

        if (file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $gallery->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $gallery->image);

        $gallery->delete();
        return response()->json(["status" => "ok"]);
    }

    public function list(Request $request)
    {
        $isVideo = $request->query('isVideo');
        if(!$isVideo || $isVideo == 'false') {
            $category = Category::whereId($request->query('albumID'))->first();
            
            if($category->section == 'gallery')
                $galleries = Gallery::whereCatId($category->id)->visible()->get();
            else if($category->section == 'article')
                $galleries = Article::where('category_id', $category->id)->visible()->get();
                
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
        else return VideoController::list($request);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean',
            'category_id' => 'required|exists:category,id'
        ]);

        $image       = $request->file('image');
        
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;

        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename));

        Gallery::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'title' => $request->has('title') ? $request['title'] : null,
            'is_imp' => $request['is_imp'],
            'cat_id' => $request['category_id']
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
            'visibility' => 'required|boolean',
            'category_id' => 'required|exists:category,id'
        ]);

        $gallery->priority = $request->priority;
        $gallery->visibility = $request->visibility;
        $gallery->cat_id = $request->category_id;
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
