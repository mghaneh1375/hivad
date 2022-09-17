<?php

namespace App\Http\Controllers;

use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\ImageManagerStatic as Image;

class PeopleController extends Controller
{
        
    public function managePeople() {
        $peoples = People::all();
        return view('admin.People.list', compact('peoples'));
    }

    public function edit(People $people) {
        return view('admin.People.create', compact('people'));
    }

    public function remove(People $people = null) {

        if($people == null)
            return abort(401);

        if(file_exists(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $people->image))
            unlink(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $people->image);

        $people->delete();
        return response()->json(["status" => "ok"]);
    }

    public function update(People $people = null, Request $request) {

        if($people == null)
            return response()->json(["status" => "nok"]);
        
        $request->validate([
            'priority' => 'required|int|min:1',
            'visibility' => 'nullable|boolean',
            'alt' => 'nullable|string|min:1',
            'bio' => 'nullable|string|min:1',
            'name' => 'nullable|string|min:1',
            'image' => 'nullable|image',
        ]);

        if($request->has('image')) {    
            $image       = $request->file('image');
            
            $img = $request->file('image')->getClientOriginalName();
            $ext = explode('.', $img);
            $ext = $ext[count($ext) - 1];

            $filename    = time() . $ext;
            
            $image_resize = Image::make($image->getRealPath());
            $image_resize->save(public_path('Content/images/shortcutTab/' . $filename));

            if(file_exists(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $people->image))
                unlink(__DIR__ . '/../../../public/Content/images/shortcutTab/' . $people->image);

            $people->image = $filename;
        }

        $people->visibility = $request->has('visibility') ? $request['visibility'] : $people->visibility;
        $people->priority = $request->priority;
        $people->alt = $request->has('alt') ? $request->alt : $people->alt;
        $people->bio = $request->has('bio') ? $request->bio : $people->bio;
        $people->name = $request->has('name') ? $request->name : $people->name;

        $people->save();
        return Redirect::route('managePeople');
    }

    public function store(Request $request) {

        $request->validate([
            'image' => 'required|image',
            'alt' => 'nullable|string|min:1',
            'priority' => 'required|integer|min:1',
            'bio' => 'required|string|min:1',
            'name' => 'required|string|min:1'
        ]);
        
        $image       = $request->file('image');
        
        $img = $request->file('image')->getClientOriginalName();
        $ext = explode('.', $img);
        $ext = $ext[count($ext) - 1];

        $filename    = time() . $ext;
        
        $image_resize = Image::make($image->getRealPath());
        $image_resize->save(public_path('Content/images/shortcutTab/' . $filename));

        People::create([
            'image' => $filename,
            'alt' => $request->has('alt') ? $request['alt'] : null,
            'priority' => $request['priority'],
            'bio' => $request['bio'],
            'name' => $request['name']
        ]);

        return Redirect::route('managePeople');
    }
}
