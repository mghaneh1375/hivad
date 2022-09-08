<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function getConfigs(Request $request) {
        return view('admin.config', ['config' => Config::first()]);
    }

    public function save(Request $request) {
        $request->validate([
            'show_insta' => 'nullable|boolean',
            'show_news' => 'nullable|boolean',
            'show_article' => 'nullable|boolean',
            'show_gallery' => 'nullable|boolean',
            'show_about' => 'nullable|boolean',
            'show_videos' => 'nullable|boolean',
        ]);

        $config = Config::first();
        $config->show_insta = $request->has('show_insta') ? $request->show_insta : $config->show_insta;
        $config->show_news = $request->has('show_news') ? $request->show_news : $config->show_news;
        $config->show_article = $request->has('show_article') ? $request->show_article : $config->show_article;
        $config->show_gallery = $request->has('show_gallery') ? $request->show_gallery : $config->show_gallery;
        $config->show_about = $request->has('show_about') ? $request->show_about : $config->show_about;
        $config->show_videos = $request->has('show_videos') ? $request->show_videos : $config->show_videos;

        $config->save();
        return response()->json(['status' => 'ok']);
    }
}
