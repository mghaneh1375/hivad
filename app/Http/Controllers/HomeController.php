<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryJSON;
use App\Http\Resources\NewsJSON;
use App\Http\Resources\SliderBarJSON;
use App\models\Category;
use App\models\City;
use App\models\Gallery;
use App\models\News;
use App\models\SlideBar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    private function get_sliders() {
        return SliderBarJSON::collection(SlideBar::visible()->orderBy('priority', 'asc')->get()); 
    }
    
    private function get_galleries() {
        return GalleryJSON::collection(Gallery::imp()->orderBy('priority', 'asc')->get()); 
    }
    
    private function get_news() {
        return NewsJSON::collection(News::imp()->orderBy('priority', 'asc')->take(3)->get()); 
    }

    private function json_file() {
        
    return [
    "madules" => [
        [
            "BoxID" => 38886,
            "MenuID" => -1,
            "BoxTitle" => "صفحه اصلی",
            "BoxDescription" => null,
            "Priority" => 1,
            "Width" => null,
            "Height" => 250,
            "BoxCount" => 1,
            "MaduleID" => null,
            "SubBoxHeight" => null,
            "BoxCountPerRow" => 1,
            "FormID" => null,
            "FormReportID" => null,
            "BoxGroupID" => 2,
            "BoxGroupName" => "slideshow",
            "BoxPersianName" => "اسلایدر",
            "Pagination" => 1,
            "SortType" => 1,
            "Content" => null,
            "MediaID" => null,
            "HasProductTabs" => null,
            "ProductSlides" => null,
            "RowIDList" => ",10118",
            "BoxStyle" => "",
            "PopupStyle" => false,
            "BoxTemp" => null,
            "ShowMoreLink" => null,
            "ContainerTabs" => null,
            "WebsiteDisplay" => true,
            "MobileDisplay" => true,
            "Background" => null,
            "ParallaxStyle" => null,
            "DisableBoxBack" => null,
            "BackTitleColor" => null,
            "DisableBoxBackgroundColor" => null,
            "BoxBackgroundColor" => null,
            "BlurEffectBack" => null,
            "BlackEffectBack" => null,
            "ButtonList" => [],
            "Platform7Maduleid" => null,
            "GroupMaduleBox" => null,
            "IsAmazzingoffer" => false
        ],
        [
            "BoxID" => 38865,
            "MenuID" => -1,
            "BoxTitle" => "گالری",
            "BoxDescription" => null,
            "Priority" => 2,
            "Width" => null,
            "Height" => 180,
            "BoxCount" => 9,
            "MaduleID" => null,
            "SubBoxHeight" => null,
            "BoxCountPerRow" => 3,
            "FormID" => null,
            "FormReportID" => null,
            "BoxGroupID" => 1,
            "BoxGroupName" => "tabs",
            "BoxPersianName" => "تب ها",
            "Pagination" => 2,
            "SortType" => 1,
            "Content" => null,
            "MediaID" => null,
            "HasProductTabs" => null,
            "ProductSlides" => null,
            "RowIDList" => null,
            "BoxStyle" => "services",
            "PopupStyle" => false,
            "BoxTemp" => null,
            "ShowMoreLink" => null,
            "ContainerTabs" => null,
            "WebsiteDisplay" => true,
            "MobileDisplay" => true,
            "Background" => null,
            "ParallaxStyle" => null,
            "DisableBoxBack" => null,
            "BackTitleColor" => null,
            "DisableBoxBackgroundColor" => null,
            "BoxBackgroundColor" => null,
            "BlurEffectBack" => null,
            "BlackEffectBack" => null,
            "ButtonList" => [],
            "Platform7Maduleid" => null,
            "GroupMaduleBox" => null,
            "IsAmazzingoffer" => false
        ],
        [
            "BoxDescription" => "",
            "BoxGroupName" => "news",
            "BoxID" =>  38931,
            "BoxPersianName" => "اخبار",
            "BoxStyle" => "",
            "BoxTemp" =>  null,
            "BoxTitle" => "آخرین اخبار",
            "ButtonList" =>  [],
            "MenuID" =>  29270,
            "MobileDisplay" =>  true,
            "PopupStyle" =>  false,
            "SortType" =>  1,
            "WebsiteDisplay" =>  true,
        ],
        // [
        //     "BoxID" => 38887,
        //     "MenuID" => -1,
        //     "BoxTitle" => "تست 3",
        //     "BoxDescription" => "این توضیح قسمت 3 است",
        //     "Priority" => 4,
        //     "Width" => null,
        //     "Height" => 250,
        //     "BoxCount" => 1,
        //     "MaduleID" => null,
        //     "SubBoxHeight" => null,
        //     "BoxCountPerRow" => 1,
        //     "FormID" => null,
        //     "FormReportID" => null,
        //     "BoxGroupID" => 7,
        //     "BoxGroupName" => "singleImage",
        //     "BoxPersianName" => "عکس تکی",
        //     "Pagination" => 2,
        //     "SortType" => 1,
        //     "Content" => null,
        //     "MediaID" => null,
        //     "HasProductTabs" => null,
        //     "ProductSlides" => null,
        //     "RowIDList" => null,
        //     "BoxStyle" => "aboutAjodanie",
        //     "PopupStyle" => false,
        //     "BoxTemp" => null,
        //     "ShowMoreLink" => null,
        //     "ContainerTabs" => null,
        //     "WebsiteDisplay" => true,
        //     "MobileDisplay" => true,
        //     "Background" => null,
        //     "ParallaxStyle" => null,
        //     "DisableBoxBack" => null,
        //     "BackTitleColor" => null,
        //     "DisableBoxBackgroundColor" => null,
        //     "BoxBackgroundColor" => null,
        //     "BlurEffectBack" => null,
        //     "BlackEffectBack" => null,
        //     "ButtonList" => [
        //         [
        //             "Text" => "دکمه 1",
        //             "LinkUrl" => "http =>//213.217.43.109",
        //             "MenuID" => null,
        //             "TempName" => null,
        //             "IsProfileMenu" => false
        //         ],
        //         [
        //             "Text" => "دکمه 2",
        //             "LinkUrl" => "http =>//213.217.43.109",
        //             "MenuID" => null,
        //             "TempName" => null,
        //             "IsProfileMenu" => false
        //         ]
        //     ],
        //     "Platform7Maduleid" => null,
        //     "GroupMaduleBox" => null,
        //     "IsAmazzingoffer" => false
        // ]
    ],
    "jsonContentList" => [
        [
            "BoxID" => 38886,
            "Content" => [
                "SlideList" => $this->get_sliders(),
                "PopupStyle" => false
            ]
        ],
        [
            "BoxID" => 38865,
            "Content" => [
                "TabRepository" => $this->get_galleries(),
                "boxCount" => 9,
                "PopupStyle" => false,
                "boxTitle" => "باکس تایتل 2",
                "BoxCountPerRow" => 3
            ]
        ],
        [
            "BoxID" => 38931,
            "Content" => [
                "Pagination" => 2,
                "ShowMoreLink" => null,
                "model" => [
                    "News" => $this->get_news(),
                    "PopupStyle" => false
                ]
            ]
        ],
        // [
        //     "BoxID" => 38887,
        //     "Content" => [
        //         "boxTitle" => "تایتل جدید",
        //         "boxDescription" => "توضیح تایتل جدید",
        //         "MediaID" => "section3"
        //     ]
        // ]
    ]
            ];


    }

    public function get_json_file() {   
        return json_encode($this->json_file());
    }

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
