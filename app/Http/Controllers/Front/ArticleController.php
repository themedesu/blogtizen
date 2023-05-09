<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use View;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $metaTitle = 'Artikel';
        $query = $request->input('query');
        $showMax = config('app.show_max');
        $articles = Article::where('title', 'LIKE', "%{$query}%")->orderBy('created_at', 'desc')->paginate($showMax ? $showMax : 6);
        $articles = $articles->appends(['query' => $query]);
        return View::make("pages.front.article.index", compact('metaTitle', 'articles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->with([
            'tagArticles' => function ($query) {
                $query->with('tag');
            },
        ])->firstOrFail();
        $metaTitle = $article->title;
        $metaLogo = $article->thumbnail_url;
        $metaDescription = $article->description ? $article->description : $article->title;
        $article->incrementHitsCount();
        $popularMax = config('app.popular_max');
        $articlePopulars = Article::whereMonth('created_at', date('m'))->orderBy('hits', 'desc')->limit($popularMax ? $popularMax : 0)->get(['id', 'title', 'content', 'thumbnail', 'slug']);
        $tags = Tag::get(['name', 'slug']);

        return View::make("pages.front.article.show", compact('metaTitle', 'metaDescription', 'metaLogo', 'article', 'articlePopulars', 'tags'));
    }
}
