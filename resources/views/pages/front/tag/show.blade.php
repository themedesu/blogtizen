@extends('layouts.front')

@section('content')
    
    @php
        $articlesArr = [];
    @endphp

    @foreach ($tag->tagArticles as $article)      
        @php
            array_push($articlesArr, $article->article);
        @endphp
    @endforeach

    @include('components.front.article', ['articles' => $articlesArr, 'tag' => $tag])


@endsection