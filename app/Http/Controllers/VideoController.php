<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoResource;
use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    
    public function manageVideo()
    {
        $videos = Video::all();
        foreach($videos as $video) {
            $video->file = asset('videos/' . $video->file);
        }
        return view('admin.Video.list', ['videos' => $videos, 'categories' => Category::all()]);
    }

    public function remove(Video $video)
    {

        if (file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image);

        if(file_exists(__DIR__ . '/../../../public/Content/images/videos/' . $video->file))
            unlink(__DIR__ . '/../../../public/Content/images/videos/' . $video->file);

        $video->delete();
        return response()->json(["status" => "ok"]);
        
    }

    public function add() {
        return view('admin.Video.create', ['categories' => Category::all()]);
    }
    
    public function editVideo(Video $video) {
        return view('admin.Video.create', [
            'categories' => Category::all(),
            'video' => $video
        ]);
    }


    public function store(Request $request)
    {
        $validator = [
            'image' => 'required|image',
            'cat_id' => 'required|exists:category,id',
            'file' => 'required|file|mimes:mp4',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator);

        $image       = $request->file('image');
        
        $filename    = time();
        
        $image_resize = Image::make($image->getRealPath());
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename . '.' . $ext));

        $video_filename = $request->file('file')->storeAs('videos', $filename . '.mp4');
        $video_filename = str_replace('videos/', '', $video_filename);

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
    
    public function update(Request $request, Video $video)
    {
        $validator = [
            'image' => 'nullable|image',
            'cat_id' => 'required|exists:category,id',
            'file' => 'nullable|file|mimes:mp4',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator, self::$errors);

        $filename    = time();

        if($request->has('image') && $request->file('image') != null) {

            $image       = $request->file('image');
                
            $image_resize = Image::make($image->getRealPath());
            $img = $request->file('image')->getClientOriginalName();
            $ext = explode('.', $img);
            $ext = $ext[count($ext) - 1];

            $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename . '.' . $ext));
               
            if (file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image))
                unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $video->image);

            $video->image = $filename . '.' . $ext;
        }

        if($request->has('file') && $request->file('file') != null) {

            $video_filename = $request->file('file')->storeAs('videos', $filename . '.mp4');
            $video_filename = str_replace('videos/', '', $video_filename);

            if(file_exists(__DIR__ . '/../../../public/Content/images/videos/' . $video->file))
                unlink(__DIR__ . '/../../../public/Content/images/videos/' . $video->file);

            $video->file = $video_filename;
        }

        foreach($request->keys() as $key) {
            
            if($key == '_token' || $key == "file" || $key == "image")
                continue;

            $video[$key] = $request[$key];
        }

        $video->save();
        return Redirect::route('manageVideo');
    }

    public static function list(Request $request, Category $category)
    {

        $galleries = Video::whereCatId($category->id)->visible()->orderBy('priority', 'desc')->get();
        $articles = VideoResource::collection($galleries);

        $arr = [    
            "TabRepository" => $articles,
            "boxCount" => 9,
            "PopupStyle" => false,
            "boxTitle" => "مقالات " . $category->title,
            "BoxCountPerRow" => 3
        ];

        return json_encode($arr);
    }

}
