@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12 col-lg-12">
            <div class="card rounded-15 border-0 shadow-sm">
                <div class="card-body article-body p-4">
                    <h2 class="mb-3 pb-2 border-bottom">{{$page->title}}</h2>
                    {!!$page->content!!}
                </div>
            </div>
        </div>
    </div>
@endsection