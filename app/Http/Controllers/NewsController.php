<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Intervention\Image\ImageManagerStatic as Image;

class NewsController extends Controller {

    public function indexAPI() {

        $news = News::all();
        foreach ($news as $itr) {

            if($itr->img != null && !empty($itr->img) &&
                file_exists(__DIR__ . '/../../../public/news/' . $itr->img)
            )
                $itr->img = URL::asset('news/' . $itr->img);
            else
                $itr->img = URL::asset('img/logo.jpeg');

            $itr->date = convertDate($itr->created_at);
        }

        return response()->json([
            "news" => $news
        ]);
    }

    public function index() {

        $news = News::all();

        foreach ($news as $itr) {

            if($itr->category != null || !empty($itr->category))
                $itr->category = Category::whereId($itr->category)->name;
            else
                $itr->category = "تعیین نشده";

            if($itr->img != null && !empty($itr->img) &&
                file_exists(__DIR__ . '/../../../public/news/' . $itr->img)
            )
                $itr->img = URL::asset('news/' . $itr->img);
            else
                $itr->img = URL::asset('img/logo.jpeg');
        }

        return view('admin.news', ['news' => $news,
            'categories' => Category::all()]);
    }

    public function manageNews() {
        return view('admin.News.list', ['allNews' => News::all()]);
    }

    public function editNews(News $news) {
        return view('admin.News.create', ['news' => $news]);
    }

    public function remove(News $news) {

        if(file_exists(__DIR__ . '/../../../public/Content/images/news/crop/' . $news->image))
            unlink(__DIR__ . '/../../../public/Content/images/news/crop/' . $news->image);

        $news->delete();
        return response()->json(["status" => "ok"]);

    }

    public function store(Request $request) {
        
        $request->validate([
            'image' => 'required|image',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'digest' => 'required|string|min:1',
            'tags' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean'
        ]);

        $image       = $request->file('image');
        
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/news/crop/' . $filename));

        News::create([
            'digest' => $request->digest,
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'description' => $request->has('description') ? $request['description'] : null,
            'tags' => $request->has('tags') ? $request['tags'] : null,
            'priority' => $request['priority'],
            'title' => $request['title'],
            'is_imp' => $request['is_imp'],
        ]);

        return Redirect::route('manageNews');
    }

    
    public function update(News $news = null, Request $request) {

        if($news == null)
            return response()->json(["status" => "nok"]);

        $request->validate([
            'image' => 'nullable|image',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'digest' => 'required|string|min:1',
            'tags' => 'nullable|string|min:1',
            'description' => 'nullable|string|min:1',
            'is_imp' => 'required|boolean',
            'visibility' => 'required|boolean',
        ]);

        $news->priority = $request->priority;
        $news->digest = $request->digest;
        $news->visibility = $request->visibility;
        $news->alt = $request->has('alt') ? $request->alt : $news->alt;
        $news->tags = $request->has('tags') ? $request->tags : $news->tags;
        $news->description = $request->has('description') ? $request->description : $news->description;
        $news->title = $request->title;
        $news->is_imp = $request->is_imp;

        if($request->has('image')) {
            $image       = $request->file('image');
            if($image != null) {
                
                $img = $request->file('image')->getClientOriginalName();
                $ext = explode('.', $img);
                $ext = $ext[count($ext) - 1];

                $filename    = time() . '.' . $ext;
                
                $image_resize = Image::make($image->getRealPath());
                $image_resize->save(public_path('Content/images/news/crop/' . $filename));
                
                if(file_exists(__DIR__ . '/../../../public/Content/images/news/crop/' . $news->image))
                    unlink(__DIR__ . '/../../../public/Content/images/news/crop/' . $news->image);
                    
                $news->image = $filename;
            }
        }

        $news->save();
        return Redirect::route('manageNews');
    }


}
