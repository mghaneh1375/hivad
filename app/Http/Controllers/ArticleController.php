<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleDigest;
use App\Http\Resources\SingleGalleryJSON;
use App\models\Article;
use App\models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class ArticleController extends Controller {

    public function index(Request $request) {
        return view('admin.Article.list', [
            'articles' => ArticleDigest::collection(Article::all())->toArray($request)
        ]);
    }

    public function show(Article $article) {

    }

    public function create() {
        return view('admin.Article.create', [
            'categories' => Category::where('section', 'article')->get()
        ]);
    }

    public function store(Request $request) {
        
        $request->validate([
            'img' => 'required|image',
            'f' => 'required|file',
            'priority' => 'required|int|min:1',
            'alt_image' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'digest' => 'required|string|min:1',
            'tags' => 'nullable|string|min:1',
            'keywords' => 'nullable|string|min:1',
            'description' => 'required|string|min:1',
            'category_id' => 'required|exists:category,id',
            'is_imp' => 'required|boolean'
        ], self::$errors);

        $image       = $request->file('img');
        
        $img = $request->file('img')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . '.' . $ext;
    
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/news/crop/' . $filename));
        $request['image'] = $filename;

        $file = $request->f->store('public/articles');
        $request['visibility'] = true;
        $request['file'] = str_replace('public/articles', '', $file);
        Article::create($request->toArray());

        return Redirect::route('articles.index');
    }
    
    public function list(Request $request)
    {
        $articles = Article::where('category_id', $request->query('albumID'))->visible()->get();
        dd($articles);
        return json_encode(
            [
                "boxID" => 38888,
                "isVideo" => false,
                "isFileGallery" => false,
                "model" => [
                    "GalleryList" => SingleGalleryJSON::collection($articles),
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

    public function destroy(Article $article) {

        if ($article->image != null && !empty($article->image) &&
            file_exists(__DIR__ . '/../../../public/Content/images/news/crop/' . $article->image))
            unlink(__DIR__ . '/../../../public/Content/images/news/crop/' . $article->image);

        if ($article->file != null && !empty($article->file) &&
            file_exists(__DIR__ . '/../../../public/storage/articles/' . $article->file))
            unlink(__DIR__ . '/../../../public/storage/articles/' . $article->file);

        $article->delete();
        return response()->json(['status' => 'ok']);
    }

    public function edit() {

    }

}
