<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class VideoController extends Controller
{
    
    public function manageVideo()
    {
        return view('admin.video', ['videos' => Video::all(), 'categories' => Category::all()]);
    }

    public function remove(Video $video)
    {

        if (file_exists(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $video->image))
            unlink(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $video->image);

        if(file_exists(__DIR__ . '/../../../public/storage/videos/' . $video->file))
            unlink(__DIR__ . '/../../../public/storage/videos/' . $video->file);

        $video->delete();
        return response()->json(["status" => "ok"]);
    }


    public function store(Request $request)
    {

        $request->validate([
            'image' => 'required|image|mimes:jpeg,jpg',
            'cat_id' => 'required|exists:category,id',
            'file' => 'required|file|mimes:mp4',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ]);

        $image       = $request->file('image');
        $filename    = time() . '.jpg';
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/shortcutTab/' . $filename));

        $filename = str_replace('.jpg', '', $filename);

        $video_filename = $request->file('file')->store('videos');
        $video_filename = str_replace('videos/', '', $video_filename);

        Video::create([
            'image' => $filename,
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

}
