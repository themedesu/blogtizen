@if (isset($articles))
    <h2 class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-3 rounded-pill px-3 fs-4">
        <span class="text-dark"><i class="bi bi-newspaper me-1"></i> Article</span>
        @if (isset($isArticleIndex))
            <form class="col-lg-3" method="GET">
                <input type="search" class="form-control form-search rounded-20 px-3" name="search" placeholder="Search article..." value="{{ request()->get('search') }}" aria-label="Search">
            </form>
        @else 
            @if (isset($tag))
                <span class="bg-menu text-menu py-2 px-3 d-inline-block rounded m-0 font-size-12">
                    <i class="bi bi-tag"></i> {{$tag->name}}
                </span>
            @else
                <a href="{{route('front.article.index')}}">
                    <span class="badge bg-light rounded-pill py-2 px-3 font-size-14 text-dark">
                        <i class="bi bi-folder2-open"></i>
                        <span class="d-none">View all</span>
                    </span>
                </a>
            @endif
        @endif
    </h2>
    <div class="row">
        @forelse ($articles as $article)
            <div class="col-12 col-md-6 col-lg-4"> 
                <div class="card article-section mb-4 rounded-20 border-0 shadow">
                    <a href="{{$article->url}}">
                        <img class="article-thumbnail" src="{{$article->thumbnail_url}}" alt="{{$article->title}}" width="auto" height="auto">
                    </a>
                    <div class="article-body card-body">
                        <div class="article-title">
                            <a href="{{$article->url}}" class="text-dark text-decoration-none">
                                <h3 class="fs-5 mb-0">{{$article->title_slice}}</h3>
                            </a>
                        </div>
                        <div class="article-meta d-flex justify-content-between align-items-center bg-light py-2 px-3 my-2 rounded-10 font-size-14">
                            <span><i class="bi bi-calendar-check"></i> {{$article->created_at}}</span>
                            <span><i class="bi bi-person"></i> {{$article->author->name}}</span>
                        </div>
                        <div class="article-summary font-size-15 text-justify">{{$article->content_slice}}</div>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-2 pb-5 mb-5">
                <div class="alert alert-light mb-0" role="alert">
                    <h4 class="alert-heading"><i class="bi bi-info-circle"></i> Ups</h4>
                    <p class="m-0">Cannot find articles in this section. Please try again later</p>
                </div>
            </div>
        @endforelse
    </div>

    @if (isset($isArticleIndex))
        {{ $articles->links() }}
    @endif
@endif