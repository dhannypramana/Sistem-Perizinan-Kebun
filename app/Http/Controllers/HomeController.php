<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public static function index()
    {
        return view('home.home', [
            'active' => 'home',
        ]);
    }

    public static function news()
    {
        $news = News::latest()->get();

        return view('news.news', [
            'active' => 'news',
            'news' => $news,
        ]);
    }

    public static function details($id)
    {
        $news = News::find($id);

        return view('news.details', [
            'active' => 'news',
            'news' => $news,
        ]);
    }
}
