@extends('layouts.front')

@section('content')
    @include('components.front.article', ['articles' => $articles, 'isArticleIndex' => true])
@endsection
