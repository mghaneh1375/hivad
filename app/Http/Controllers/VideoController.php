<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoController extends Controller
{
    
    public function manageVideo()
    {
        return view('admin.video', ['videos' => Video::all()]);
    }

}
