<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    
    public function manageCategory() {
        return view('admin.category', ['categories' => Category::all()]);
    }

    public function remove(Category $category) {

        if(file_exists(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $category->image))
            unlink(__DIR__ . '/../../../public/Content/images/GalleryPictures/crop/' . $category->image);
    
        $category->delete();
        return response()->json(["status" => "ok"]);

    }

    public function store(Request $request) {
        
        $request->validate([
            'image' => 'required|image',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'section' => ['required', Rule::in(['gallery', 'article', 'shop'])],
        ]);

        $image       = $request->file('image');
        $n = $image->getClientOriginalName();
        $arr = explode('.', $n);
        $filename    = time() . '.' . $arr[count($arr) - 1];
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename));

        Category::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'title' => $request['title'],
            'section' => $request['section'],
        ]);

        return Redirect::route('manageCategory');
    }

    public function update(Category $category, Request $request) {
        
        $request->validate([
            'image' => 'nullable|image',
            'priority' => 'required|int|min:1',
            'alt' => 'nullable|string|min:1',
            'title' => 'required|string|min:1',
            'section' => ['required', Rule::in(['gallery', 'article', 'shop'])],
        ]);

        if($request->has('image')) {
            $image       = $request->file('image');
            $n = $image->getClientOriginalName();
            $arr = explode('.', $n);
            $filename    = time() . '.' . $arr[count($arr) - 1];
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path('Content/images/GalleryPictures/crop/' . $filename));
        }

        $category->alt = $request->has('alt') ? $request['alt'] : $category->alt;
        $category->title = $request['title'];
        $category->section = $request['section'];
        $category->priority = $request['priority'];
        
        $category->save();
        return response()->json(['status' => 'ok']);
    }


}
