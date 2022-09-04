<?php

namespace App\Http\Controllers;

use App\models\Article;
use App\models\Category;
use App\models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ArticleController extends Controller {

    public function indexAPI() {

        $articles = Article::all();
        foreach ($articles as $article) {

            if($article->img != null && !empty($article->img) &&
                file_exists(__DIR__ . '/../../../public/article/' . $article->img)
            )
                $article->img = URL::asset('article/' . $article->img);
            else
                $article->img = URL::asset('img/logo.jpeg');

        }

        return response()->json([
            "articles" => $articles
        ]);
    }

    public function index() {

        $articles = Article::all();

        foreach ($articles as $article) {
            if($article->category != null || !empty($article->category))
                $article->category = Category::whereId($article->category)->name;
            else
                $article->category = "تعیین نشده";

            if($article->img != null && !empty($article->img) &&
                file_exists(__DIR__ . '/../../../public/article/' . $article->img)
            )
                $article->img = URL::asset('article/' . $article->img);
            else
                $article->img = URL::asset('img/logo.jpeg');
        }

        return view('admin.articles', ['articles' => $articles,
            'categories' => Category::all()]);

    }

    public function show(Article $article) {

    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required'
        ]);

        $article = new Article();
        $article->title = $request["title"];

        if(isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
            $file = Input::file('img');
            $Image = time() . '_' . $file->getClientOriginalName();

            $destenationpath = __DIR__ . '/../../../public/article';
            $file->move($destenationpath, $Image);

            $article->img = $Image;
        }

        if(isset($_FILES["file"]) && !empty($_FILES["file"]["name"])) {
            $file = Input::file('file');
            $Image = time() . '_' . $file->getClientOriginalName();

            $destenationpath = __DIR__ . '/../../../public/article';
            $file->move($destenationpath, $Image);

            $article->file = $Image;
        }

        if(isset($_POST["description"]) && !empty($_POST["description"]))
            $article->description = $_POST["description"];

        if($_POST["category"] != -1)
            $article->category = $_POST["category"];

        $article->save();

        return Redirect::route('manageArticles');
    }

    public function delete() {

        if(myPostIsset(["id"])) {

            $article = Article::whereId(makeValidInput($_POST["id"]));

            if($article != null) {

                if ($article->img != null && !empty($article->img) &&
                    file_exists(__DIR__ . '/../../../public/article/' . $article->img))
                    unlink(__DIR__ . '/../../../public/article/' . $article->img);

                if ($article->file != null && !empty($article->file) &&
                    file_exists(__DIR__ . '/../../../public/article/' . $article->file))
                    unlink(__DIR__ . '/../../../public/article/' . $article->file);

                $article->delete();
            }
        }

        return Redirect::route('manageArticles');

    }

    public function edit() {

    }

}
