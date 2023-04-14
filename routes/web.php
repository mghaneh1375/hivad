<?php

use App\Http\Controllers\AdviceFormController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CafeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PeopleWorkTimeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserAdviceRequestController;
use App\Http\Controllers\VideoController;
use App\Http\Resources\PeopleResource;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\News;
use App\Models\People;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;

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

Route::get('spec-articles-get_json_file/{category}', [HomeController::class, 'spec_articles_get_json_file'])->name('spec_articles_get_json_file');

Route::get('spec-category-get_json_file/{category}', [HomeController::class, 'spec_category_get_json_file'])->name('spec_category_get_json_file');

Route::get('news-get_json_file', [HomeController::class, 'news_get_json_file'])->name('news_get_json_file');

Route::get('shop-get_json_file', [HomeController::class, 'shop_get_json_file'])->name('shop-get_json_file');

Route::get('my-products-get_json_file', [HomeController::class, 'my_products_get_json_file'])->name('my-products-get_json_file');

Route::get('article-get_json_file', [HomeController::class, 'article_get_json_file'])->name('article_get_json_file');

Route::get('galleries-get_json_file', [HomeController::class, 'galleries_get_json_file'])->name('galleries_get_json_file');

Route::get('videos-get_json_file', [HomeController::class, 'videos_get_json_file'])->name('videos_get_json_file');

Route::get('contact-get_json_file', [HomeController::class, 'contact_get_json_file'])->name('contact-get_json_file');

Route::get('survey-get_json_file', [HomeController::class, 'survey_get_json_file'])->name('survey-get_json_file');

Route::get('advice-request-get_json_file', [HomeController::class, 'advice_request_get_json_file'])->name('advice-request-get_json_file');


Route::middleware(['adminAccess'])->group(function() {
    
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



    Route::resource('articles', ArticleController::class)->only('index', 'edit', 'create');

    Route::resource('schedule', ScheduleController::class)->only('index', 'edit');

    Route::resource('schedule.people_work_times', PeopleWorkTimeController::class)->shallow()->except('store', 'destroy', 'update', 'show');


    Route::get('survey/forms', [SurveyController::class, 'index'])->name('survey.forms');

    Route::get('survey/forms/{form}/show', [SurveyController::class, 'showForm'])->name('survey.forms.show');

    Route::get('survey/questions', [SurveyController::class, 'show'])->name('survey.questions.list');

    Route::get('survey/question/create', [SurveyController::class, 'create'])->name('survey.questions.create');

    Route::get('survey/question/{field}/edit', [SurveyController::class, 'edit'])->name('survey.questions.edit');


    Route::get('advice/forms', [AdviceFormController::class, 'index'])->name('advice.forms');

    Route::get('advice/forms/{form}/show', [SurveyController::class, 'showForm'])->name('advice.forms.show');

    Route::get('advice/questions', [AdviceFormController::class, 'show'])->name('advice.questions.list');

    Route::get('advice/question/create', [AdviceFormController::class, 'create'])->name('advice.questions.create');

    Route::get('advice/question/{field}/edit', [AdviceFormController::class, 'edit'])->name('advice.questions.edit');




    Route::get('manageNews', [NewsController::class, 'manageNews'])->name('manageNews');

    Route::get('editNews/{news}', [NewsController::class, 'editNews'])->name('editNews');

    Route::view('addNews', 'admin.News.create')->name('addNews');



    Route::get('manageProducts', [ProductController::class, 'manageProducts'])->name('manageProducts');

    Route::get('editProduct/{product}', [ProductController::class, 'editProduct'])->name('editProduct');

    Route::view('addProduct', 'admin.Product.create')->name('addProduct');

    Route::get('reportProduct', [ProductController::class, 'report'])->name('product.report');



    Route::get('manageSlideShow', [SlideController::class, 'manageSlideShow'])->name('manageSlideShow');

    Route::get('manageIntroduce', [IntroduceController::class, 'manageIntroduce'])->name('manageIntroduce');

    Route::post('saveSlideShow', ['as' => 'saveSlideShow', 'uses' => 'SlideController@saveSlideShow']);


    Route::get('user_advice_requests', [UserAdviceRequestController::class, 'index'])->name('user_advice_requests');


    Route::get('msgs', [HomeController::class, 'msgs'])->name('msgs');

    Route::get('panel', [HomeController::class, 'panel'])->name('panel');

});


Route::group(['middleware' => ['shareWithAllViews']], function() {

    Route::any('verification', [ProductController::class, 'verification']);

    Route::get('failed/{err}/{transaction?}', [ProductController::class, 'failed']);

    Route::view('/', 'home')->name('home');

    Route::view('news', 'news');

    Route::view('shop', 'shop');

    Route::view('cafe', 'cafe');

    Route::view('people', 'people');

    Route::get('News/{news}/{title}', function (News $news, $title) {
        $d = date("Y-m-d H:i:s", strtotime($news->created_at));
        return view('single-news', compact('news', 'd'));
    });

    Route::get('Product/{product}/{title}', function (Product $product, $title) {
        
        $can_buy = true;

        if(Auth::check() && 
            Transaction::where('user_id', Auth::user()->id)->where('product_id', $product->id)
                ->where('status', Transaction::COMPLETE)->first() != null
        ) {
            $can_buy = false;
        }
        
        return view('single-product', compact('product', 'can_buy'));

    })->name('product');

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

    Route::view('contactUs', 'contact')->name('contactUs');

    Route::view('survey', 'survey')->name('survey');

    Route::view('show-articles', 'articles')->name('articles.show');
    
    Route::get('spec-articles/{category}', function(Category $category) {
        return view('spec-articles', compact('category'));
    });
    
    Route::get('spec-category/{category}', function(Category $category) {
        return view('spec-category', compact('category'));
    });

    Route::get('spec-article/{article}', function(Article $article) {
        return view('spec-article', compact('article'));
    })->name('spec-article');
    

    Route::get('workTimes', [ScheduleController::class, 'show'])->name('workTimes');

    Route::view('adviceRequest', 'advice_request')->name('adviceRequest');

    Route::get('/Home/GetGalleryList/{category}', [GalleryController::class, 'list']);

    Route::get('/Home/GetArticleList/{category}', [ArticleController::class, 'list']);

    Route::middleware(['myAuth'])->group(function() {

        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        
        Route::post('edit', [AuthController::class, 'edit'])->name('edit');

        Route::post('changePass', [AuthController::class, 'changePass'])->name('changePass');

        Route::view('my-products', 'my-products')->name('products.my');

        Route::get('my-product/{product}', [ProductController::class, 'myProduct'])->name('product.my');

        Route::any('payment/{product}', [ProductController::class, 'payment'])->name('payment');

        Route::get('success/{transaction}', [ProductController::class, 'success'])->name('success');
        
        Route::get('failed', [ProductController::class, 'failed'])->name('failed');

    });


});


Route::post('activateAccount', [AuthController::class, 'activate'])->name('activateAccount');

Route::post('signIn', [AuthController::class, 'login'])->name('signIn');

Route::post('signUp', [AuthController::class, 'signUp'])->name('signUp');

Route::post('submitForm', [AuthController::class, 'submitForm']);