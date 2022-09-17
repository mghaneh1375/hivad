<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\VideoController;
use App\Http\Resources\PeopleResource;
use Illuminate\Support\Facades\Route;
use App\models\News;
use App\Models\People;
use App\models\Video;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('get_json_file', [HomeController::class, 'get_json_file'])->name('get_json_file');

Route::get('cafe-get_json_file', [HomeController::class, 'cafe_get_json_file'])->name('cafe-get_json_file');

Route::get('people-get_json_file', [HomeController::class, 'people_get_json_file'])->name('people_get_json_file');

Route::get('news-get_json_file', [HomeController::class, 'news_get_json_file'])->name('news_get_json_file');

Route::get('galleries-get_json_file', [HomeController::class, 'galleries_get_json_file'])->name('galleries_get_json_file');

Route::get('videos-get_json_file', [HomeController::class, 'videos_get_json_file'])->name('videos_get_json_file');

Route::get('contact-get_json_file', [HomeController::class, 'contact_get_json_file'])->name('contact-get_json_file');

Route::get('showGallery', ['as' => 'showGallery', 'uses' => 'GalleryController@showGallery']);

Route::post('fetchGallery', ['as' => 'fetchGallery', 'uses' => 'GalleryController@fetchGallery']);

Route::get('manageCategory', [CategoryController::class, 'manageCategory'])->name('manageCategory');

Route::get('manageGallery', [GalleryController::class, 'manageGallery'])->name('manageGallery');

Route::get('managePeople', [PeopleController::class, 'managePeople'])->name('managePeople');

Route::view('addPeople', 'admin.People.create')->name('people.create');

Route::get('editPeople/{people}', [PeopleController::class, 'edit'])->name('people.edit');

Route::get('manageConfig', [ConfigController::class, 'getConfigs'])->name('manageConfig');

Route::get('manageVideo', [VideoController::class, 'manageVideo'])->name('manageVideo');

Route::get('manageCafe', [CafeController::class, 'manageCafe'])->name('manageCafe');

Route::get('editVideo/{video}', [VideoController::class, 'editVideo'])->name('editVideo');

Route::get('addVideo', [VideoController::class, 'add'])->name('addVideo');


Route::get('manageNews', [NewsController::class, 'manageNews'])->name('manageNews');

Route::get('editNews/{news}', [NewsController::class, 'editNews'])->name('editNews');

Route::view('addNews', 'admin.News.create')->name('addNews');

Route::get('manageSlideShow', [SlideController::class, 'manageSlideShow'])->name('manageSlideShow');

Route::get('manageIntroduce', [IntroduceController::class, 'manageIntroduce'])->name('manageIntroduce');

Route::post('saveSlideShow', ['as' => 'saveSlideShow', 'uses' => 'SlideController@saveSlideShow']);


Route::get('msgs', [HomeController::class, 'msgs'])->name('msgs');


Route::get('panel', [HomeController::class, 'panel'])->name('panel');

Route::view('/', 'home');

Route::view('news', 'news');

Route::view('cafe', 'cafe');

Route::view('people', 'people');

Route::get('News/{news}/{title}', function (News $news, $title) {
    $d = date("Y-m-d H:i:s", strtotime($news->created_at));
    return view('single-news', compact('news', 'd'));
});

Route::get('Video/{video}', function (Video $video) {
    $video->file = asset('storage/videos/' . $video->file);
    return view('single-video', ['video' => $video]);
});

Route::get('Home/GetProductGroupManager', function() {
    $people = PeopleResource::collection(People::visible()->orderBy('priority', 'asc')->get());
    $arr = [    
        "TabRepository" => $people,
        "boxCount" => 9,
        "PopupStyle" => false,
        "boxTitle" => "متخصصین",
        "BoxCountPerRow" => 3
    ];

    return json_encode($arr);
});

Route::view('galleries', 'galleries');

Route::view('videos', 'videos');

Route::view('contactUs', 'contact');

Route::get('/Home/GetGalleryList', [GalleryController::class, 'list']);

Route::view('a', 'a');

Route::post('submitForm', [HomeController::class, 'submitForm']);