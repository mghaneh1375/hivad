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
            'show_products' => 'nullable|boolean',
            'show_survey' => 'nullable|boolean',
            'online_booking' => 'nullable|boolean',
        ]);

        $config = Config::first();
        $config->show_insta = $request->has('show_insta') ? $request->show_insta : $config->show_insta;
        $config->show_news = $request->has('show_news') ? $request->show_news : $config->show_news;
        $config->show_products = $request->has('show_products') ? $request->show_products : $config->show_products;
        $config->show_survey = $request->has('show_survey') ? $request->show_survey : $config->show_survey;
        $config->show_article = $request->has('show_article') ? $request->show_article : $config->show_article;
        $config->show_gallery = $request->has('show_gallery') ? $request->show_gallery : $config->show_gallery;
        $config->show_about = $request->has('show_about') ? $request->show_about : $config->show_about;
        $config->show_videos = $request->has('show_videos') ? $request->show_videos : $config->show_videos;
        $config->online_booking = $request->has('online_booking') ? $request->online_booking : $config->online_booking;

        $config->save();
        return response()->json(['status' => 'ok']);
    }
}
