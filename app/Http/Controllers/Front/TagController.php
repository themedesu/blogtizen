<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use View;

class TagController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->with([
            'tagArticles' => function ($query) {
                $query->with('article');
            },
        ])->firstOrFail();
        $metaTitle = $tag->name;
        return View::make("pages.front.tag.show", compact('metaTitle', 'tag'));
    }
}
