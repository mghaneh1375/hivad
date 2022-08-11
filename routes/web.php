<?php

use App\Http\Controllers\SlideController;
use Illuminate\Support\Facades\Route;

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


Route::get('galleries', ['as' => 'gallery', 'uses' => 'GalleryController@gallery']);

Route::post('addGallery', ['as' => 'addGallery', 'uses' => 'GalleryController@addGallery']);

Route::post('deleteGallery', ['as' => 'deleteGallery', 'uses' => 'GalleryController@deleteGallery']);

Route::get('showGallery', ['as' => 'showGallery', 'uses' => 'GalleryController@showGallery']);

Route::post('fetchGallery', ['as' => 'fetchGallery', 'uses' => 'GalleryController@fetchGallery']);

Route::get('manageSlideShow', [SlideController::class, 'manageSlideShow'])->name('manageSlideShow');

Route::post('saveSlideShow', ['as' => 'saveSlideShow', 'uses' => 'SlideController@saveSlideShow']);


Route::get('/', function () {
    return view('home');
});
