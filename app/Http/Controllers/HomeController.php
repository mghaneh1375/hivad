<?php

namespace App\Http\Controllers;

use App\models\Article;
use App\models\Category;
use App\models\City;
use App\models\Gallery;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function login() {

        if(Auth::check())
            return Redirect::route('home');

        return view('login2', ['msg' => '']);
    }

    public function doLogin() {

        if(myPostIsset(["username"]) && myPostIsset(["password"])) {

            $username = makeValidInput($_POST["username"]);
            $password = makeValidInput($_POST["password"]);

            if(Auth::attempt(['username' => $username, 'password' => $password], true)) {

                if(!Auth::user()->status) {
                    Auth::logout();
                    Session::flush();
                    return view('login', ['msg' => 'حساب کاربری شما فعال نیست']);
                }

                return Redirect::route('home');
            }

            return view('login', ['msg' => 'نام کاربری یا رمز عبور را اشتباه وارد کرده اید']);
        }

        return view('login', ['msg' => '']);
    }

    public function getCities() {

        if(myPostIsset(["stateId"])) {
            echo json_encode(City::whereStateId(makeValidInput($_POST["stateId"]))->get());
        }

    }

    public function doChangePass() {

        if(isset($_POST["oldPass"]) && isset($_POST["newPass"]) &&
            isset($_POST["confirmPass"])
        ) {

            $user = Auth::user();

            $oldPass = $_POST["oldPass"];
            $newPass = $_POST["newPass"];
            $confirmPass = $_POST["confirmPass"];

            if($newPass == $confirmPass) {

                if (Hash::check($oldPass, $user->password)) {
                    $user->password = Hash::make($newPass);
                    $user->save();
                    echo "ok";
                }
                else
                    echo "nok2";

                return;
            }
            else {
                echo "nok1";
            }

        }

    }

    public function logout() {
        Auth::logout();
        Session::flush();
        return Redirect::route('home');
    }

    public function changePass() {
        return view('changePass');
    }

    public function managers() {
        return view('managers');
    }

    public function home() {

        $gallery = Gallery::all()->take(4);
        foreach ($gallery as $g) {
            $g->category = Category::whereId($g->category)->name;
        }
        return view('home2', ['gallery' => $gallery]);
    }

}
