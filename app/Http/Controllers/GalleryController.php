<?php

namespace App\Http\Controllers;

use App\models\Category;
use App\models\Gallery;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class GalleryController extends Controller {

    public function fetchGallery() {

        $pics = [];

        if(myPostIsset("filter")) {

            if(is_array($_POST["filter"])) {

                $selected = $_POST["filter"];
                $sql = "";
                $first = true;
                foreach ($selected as $itr) {
                    if($first) {
                        $first = false;
                        $sql .= "c.id = " . $itr . " ";
                    }
                    else {
                        $sql .= "or c.id = " . $itr . " ";
                    }
                }

                $pics = DB::select('select g.*, c.name as categoryName from category c, gallery g where g.category = c.id and (' . $sql . ') order by id desc');

                foreach ($pics as $pic) {
                    $pic->name = URL::asset('gallery/' . $pic->name);
                }

            }
            else {

                $pics = DB::select('select g.*, c.name as categoryName from category c, gallery g where g.category = c.id order by id desc');

                foreach ($pics as $pic) {
                    $pic->name = URL::asset('gallery/' . $pic->name);
                }

            }

        }

        echo json_encode($pics);
    }

    public function addGallery() {

        if(isset($_FILES["pic"]) && !empty($_FILES["pic"]["name"]) &&
            myPostIsset("category")
        ) {

            $files = Input::file('pic');
            $title = (myPostIsset("title")) ? makeValidInput($_POST["title"]) : "";
            $category = makeValidInput($_POST["category"]);

            foreach ($files as $file) {

                $pic = new Gallery();

                $pic->title = $title;
                $pic->category = $category;

                $Image = time() . '_' . $file->getClientOriginalName();

                $destenationpath = __DIR__ . '/../../../public/gallery';
                $file->move($destenationpath, $Image);

                $pic->name = $Image;
                $pic->save();
            }

        }

        return Redirect::route('gallery');
    }

    public function showGallery() {
        $categories = Category::all();
        return view('showGallery', ['categories' => $categories]);
    }

    public function deleteGallery() {

        if(myPostIsset(["id"])) {

            $gallery = Gallery::whereId(makeValidInput($_POST["id"]));

            if($gallery != null) {

                if (file_exists(__DIR__ . '/../../../public/gallery/' . $gallery->name))
                    unlink(__DIR__ . '/../../../public/gallery/' . $gallery->name);

                $gallery->delete();
            }
        }

        return Redirect::route('gallery');
    }

    public function gallery() {

        $pics = DB::select('select g.*, c.name as categoryName from category c, gallery g where g.category = c.id');

        foreach ($pics as $pic) {
            $pic->name = URL::asset('gallery/' . $pic->name);

        }

        $categories = Category::all();

        return view('admin.gallery', ['pics' => $pics, 'categories' => $categories]);
    }

}

