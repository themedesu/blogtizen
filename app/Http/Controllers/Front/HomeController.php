<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use View;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        $showMax = config('app.show_max');
        $articles = Article::where('title', 'LIKE', "%{$query}%")->orderBy('created_at', 'desc')->paginate($showMax ? $showMax : 6);
        $articles = $articles->appends(['search' => $query]);
        return View::make('pages.front.home', compact('articles'));
    }
}
