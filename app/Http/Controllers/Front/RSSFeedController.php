<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Response;
use View;

class RSSFeedController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->with('author')->get();
        $response = Response::make(View::make("pages.front.rssfeed", compact('articles')));
        $response->header('Content-Type', 'text/xml');
        return $response;
    }

}
