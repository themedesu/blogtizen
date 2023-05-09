@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-9">
            <div class="card rounded-15 border-0 shadow-sm mb-4 mb-lg-0">
                <div class="card-body article-body p-0">
                    <img class="article-banner" src="{{$article->thumbnail_url}}" alt="{{$article->title}}" width="auto" height="auto">
                    @if ($article->thumbnail_credit)
                    <div class="px-4">
                        <div class="mt-2 font-size-14 text-muted">
                        <i>Source Image: {{$article->thumbnail_credit}}</i>
                        </div>
                    </div>
                    @endif
                    <div class="p-4">
                        <h2 class="mb-3">{{$article->title}}</h2>
                        <div class="article-meta d-flex justify-content-between align-items-center bg-light py-2 px-3 mb-3 rounded-10 font-size-14">
                            <span><i class="bi bi-calendar-check"></i> {{$article->created_at}}</span>
                            <span><i class="bi bi-person"></i> {{$article->author->name}}</span>
                        </div>

                        @if (isset($settingAdsArticleTop))
                            <div class="mb-3">
                                {!!$settingAdsArticleTop!!}
                            </div>
                        @endif

                        {!!$article->content!!}

                        @if (isset($settingAdsArticleBottom))
                            <div class="mt-3">
                                {!!$settingAdsArticleBottom!!}
                            </div>
                        @endif

                        @if (count($article->tagArticles) > 0)
                            <div class="mt-3">
                                Tag: 
                                @foreach ($article->tagArticles as $tagArticle)
                                    <a href="{{$tagArticle->tag->url}}">
                                        <span class="badge bg-light rounded-pill py-2 px-3 font-size-13 text-dark ms-1 mb-1">
                                            <i class="bi bi-tag"></i> {{$tagArticle->tag->name}}
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-3">
            @include('components.front.sidebar', ['articlePopulars' => $articlePopulars, 'tags' => $tags])
        </div>
    </div>
@endsection