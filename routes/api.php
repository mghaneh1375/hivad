<?php

use App\Http\Controllers\CafeController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::put('setAboutUs', [IntroduceController::class, 'setAboutUs'])->name('api.setAboutUs');

Route::put('setAboutCafe', [CafeController::class, 'setAboutCafe'])->name('api.setAboutCafe');


Route::put('updateIntroduce/{introduce?}', [IntroduceController::class, 'update'])->name('api.updateIntroduce');

Route::post('addIntroduce', [IntroduceController::class, 'store'])->name('api.addIntroduce');

Route::delete('removeIntroduce/{introduce?}', [IntroduceController::class, 'remove'])->name('api.removeIntroduce');


Route::put('updateCafeItem/{cafe?}', [CafeController::class, 'update'])->name('api.updateCafeItem');

Route::post('addCafeItem', [CafeController::class, 'store'])->name('api.addCafeItem');

Route::delete('removeCafeItem/{cafe?}', [CafeController::class, 'remove'])->name('api.removeCafeItem');



Route::post('updatePeople/{people?}', [PeopleController::class, 'update'])->name('api.updatePeople');

Route::post('addPeople', [PeopleController::class, 'store'])->name('api.addPeople');

Route::delete('removePeople/{people?}', [PeopleController::class, 'remove'])->name('api.removePeople');



Route::post('addSlide', [SlideController::class, 'store'])->name('api.addSlide');

Route::delete('removeSlide/{slidebar?}', [SlideController::class, 'remove'])->name('api.removeSlide');

Route::put('updateSlider/{slidebar?}', [SlideController::class, 'update'])->name('api.updateSlide');


Route::post('addGallery', [GalleryController::class, 'store'])->name('api.addGallery');

Route::delete('removeGallery/{gallery?}', [GalleryController::class, 'remove'])->name('api.removeGallery');

Route::put('updateGallery/{gallery?}', [GalleryController::class, 'update'])->name('api.updateGallery');


Route::post('uploadImg', [HomeController::class, 'uploadImg'])->name('api.uploadImg');


Route::post('addNews', [NewsController::class, 'store'])->name('api.addNews');

Route::delete('removeNews/{news?}', [NewsController::class, 'remove'])->name('api.removeNews');

Route::post('updateNews/{news?}', [NewsController::class, 'update'])->name('api.updateNews');


Route::post('addCategory', [CategoryController::class, 'store'])->name('api.addCategory');

Route::delete('removeCategory/{category?}', [CategoryController::class, 'remove'])->name('api.removeCategory');

Route::post('updateCategory/{category?}', [CategoryController::class, 'update'])->name('api.updateCategory');


Route::post('updateConfig', [ConfigController::class, 'save'])->name('api.updateConfig');


Route::post('addVideo', [VideoController::class, 'store'])->name('api.addVideo');

Route::delete('removeVideo/{video?}', [VideoController::class, 'remove'])->name('api.removeVideo');

Route::post('updateVideo/{video?}', [VideoController::class, 'update'])->name('api.updateVideo');


Route::delete('removeMsg/{msg}', [HomeController::class, 'removeMsg'])->name('api.removeMsg');