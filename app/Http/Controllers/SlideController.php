<?php

namespace App\Http\Controllers;


use App\models\SlideBar;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class SlideController extends Controller {

    public function manageSlideShow() {
        $slid = SlideBar::all();
        return view('admin.slides', ['slide' => $slid]);
    }

    public function saveSlideShow() {

        if ($_POST['kind'] == 'save' && isset($_FILES["pic"]) && $_FILES['pic']['name'] != '') {
            $slide = new SlideBar();

            $file = Input::file('pic');
            $Image = time() . '_' . $file->getClientOriginalName();
            $destenationpath = __DIR__ . '/../../../public/slidebar';
            $file->move($destenationpath, $Image);

            $slide->pic = $Image;
            $slide->save();
        }

        elseif ($_POST['kind'] == 'delete' && $_POST['id'] != '') {
            $slide = SlideBar::whereId($_POST['id']);
            File::delete('slidebar/' . $slide->pic);
            $slide->delete();
        }


        return Redirect::route('manageSlideShow');
    }
}
