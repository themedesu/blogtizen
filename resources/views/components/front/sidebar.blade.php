<aside class="sidebar">
    @if (isset($tags))
        <div class="tag mb-4">
            <h2 class="mb-3"><i class="bi bi-tags"></i> Tag</h2>
            @forelse ($tags as $tag)
                <a href="{{$tag->url}}">
                    <span class="badge bg-light rounded-pill py-2 px-3 font-size-13 text-dark me-1 mb-1">
                        <i class="bi bi-tag"></i> {{$tag->name}}
                    </span>
                </a>
            @empty
                <div class="alert alert-warning">
                    Tag not found
                </div>
            @endforelse
        </div>
    @endif
    @if (isset($articlePopulars))
        @if (count($articlePopulars) > 0)
            <div class="popular mb-4">
                <h2 class="mb-3"><i class="bi bi-fire"></i> On This Month</h2>
                @foreach ($articlePopulars as $article)
                    <div class="row popular mb-2">
                        <div class="col-4">
                            <a href="{{$article->url}}"><img class="img-thumbnail popular-thumbnail p-0" src="{{$article->thumbnail_url}}" alt="{{$article->title}}" width="auto" height="auto"></a>
                        </div>
                        <div class="col-8 ps-0">
                            <a href="{{$article->url}}"><h3 class="popular-title">{{($article->title_slice)}}</h3></a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</aside>
