<?php

namespace App\Http\Controllers;

use App\Http\Resources\SingleGalleryJSON;
use App\models\Category;
use App\models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    
    public function manageVideo()
    {
        $videos = Video::all();
        foreach($videos as $video) {
            $video->file = asset('storage/videos/' . $video->file);
        }
        return view('admin.Video.list', ['videos' => $videos, 'categories' => Category::all()]);
    }

    public function remove(Video $video)
    {

        if (file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image);

        if(file_exists(__DIR__ . '/../../../public/storage/videos/' . $video->file))
            unlink(__DIR__ . '/../../../public/storage/videos/' . $video->file);

        $video->delete();
        return response()->json(["status" => "ok"]);
        
    }

    public function add() {
        return view('admin.Video.create', ['categories' => Category::all()]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'cat_id' => 'required|exists:category,id',
            'file' => 'required|file|mimes:mp4',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ]);

        $image       = $request->file('image');
        
        $filename    = time();
        
        $image_resize = Image::make($image->getRealPath());
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename . '.' . $ext));

        $video_filename = $request->file('file')->storeAs('public/videos', $filename . '.mp4');
        $video_filename = str_replace('public/videos/', '', $video_filename);

        Video::create([
            'image' => $filename . '.' . $ext,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'title' => $request->has('title') ? $request['title'] : null,
            'is_imp' => $request['is_imp'],
            'description' => $request->has('description') ? $request['description'] : null,
            'file' => $video_filename,
            'cat_id' => $request->cat_id
        ]);

        return Redirect::route('manageVideo');
    }

    public static function list(Request $request)
    {
        $category = Category::whereId($request->query('albumID'))->first();
        $galleries = Video::whereCatId($category->id)->where('visibility', true)->get();
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

}
