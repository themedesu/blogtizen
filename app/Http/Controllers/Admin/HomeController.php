<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Visitor;
use DB;
use View;

class HomeController extends Controller
{
    public function index()
    {
        $visitors = Visitor::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(10)
            ->get();

        $visitors = $visitors->sortBy(function ($col) {
            return $col;
        })->values()->all();

        $popularMax = config('app.popular_max');
        $articlePopulars = Article::whereMonth('created_at', date('m'))->orderBy('hits', 'desc')->limit($popularMax ? $popularMax : 0)->get(['id', 'title', 'thumbnail', 'slug', 'hits']);
        return View::make('pages.admin.home', compact('articlePopulars', 'visitors'));
    }
}
