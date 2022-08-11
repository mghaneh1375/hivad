<?php

namespace App\Http\Controllers;

use App\models\Article;
use App\models\Category;
use App\models\Gallery;
use App\models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

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

    public function show(News $news) {

    }

    public function store(Request $request) {

        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $news = new News();
        $news->title = $request["title"];

        if(isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
            $file = Input::file('img');
            $Image = time() . '_' . $file->getClientOriginalName();

            $destenationpath = __DIR__ . '/../../../public/news';
            $file->move($destenationpath, $Image);

            $news->img = $Image;
        }

        $news->description = $_POST["description"];

        if($_POST["category"] != -1)
            $news->category = $_POST["category"];

        $news->save();

        return Redirect::route('manageNews');
    }

    public function delete() {

        if(myPostIsset(["id"])) {

            $news = News::whereId(makeValidInput($_POST["id"]));

            if($news != null) {

                if ($news->img != null && !empty($news->img) &&
                    file_exists(__DIR__ . '/../../../public/news/' . $news->img))
                    unlink(__DIR__ . '/../../../public/news/' . $news->img);

                $news->delete();
            }
        }

        return Redirect::route('manageNews');

    }

}
