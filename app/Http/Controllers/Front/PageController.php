<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Page;
use View;

class PageController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)->firstOrFail();
        $page->incrementHitsCount();
        $metaTitle = $page->title;
        $metaDescription = $page->title;

        return View::make("pages.front.page.show", compact('metaTitle', 'metaDescription', 'page'));
    }
}
