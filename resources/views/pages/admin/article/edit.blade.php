@extends('layouts.admin')

@section('extend_assets_css')
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('plugins/select2/select2-bootstrap4.min.css') }}" />
@endsection

@section('extend_assets_js')
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('extend_assets_js_native')

    <script>
        $(document).ready(function(){
            $('#tags').select2({
                theme: "bootstrap4"
            });
            
            $('#thumbnail-delete').on('click', function() {
                document.getElementById("thumbnail-is-updated").value=1;
                document.getElementById("thumbnail-preview-src").src='';
                document.getElementById("thumbnail-preview-block").style.display = "none";
                document.getElementById("thumbnail-block").style.display = "block";
            });
        });
    </script>

    @include('components.admin.tinymce.editor')
    @include('components.status')
@endsection

@section('content')
    @php
        use \App\Models\TagArticle;
    @endphp

    <div class="block block-rounded">
        <form action="{{ route('admin.article.update', ['article' => $article->id]) }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <input type="hidden" id="thumbnail-is-updated" name="thumbnail_is_updated" value="0">
            <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
                <h3 class="block-title">Article <small class="font-size-13">> Edit {{$article->title_slice}}</small></h3>
                <a href="{{ route('admin.article.index') }}" class="btn btn-light font-size-12"> 
                    <i class="bi bi-backspace-fill"></i> Back
                </a>
            </div>
            <div class="block-content block-content-full py-3">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="form-group mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{$article->title}}" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tags" class="col-form-label">Tag:</label>
                            <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                                @forelse ($tags as $tag)
                                    @php
                                        $tagNews = \App\Models\TagArticle::where('tag_id', $tag->id)->where('article_id', $article->id)->first();
                                    @endphp
                                    @if ($tagNews)
                                        <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
                                    @else 
                                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                                    @endif
                                @empty
                                    <div>Tag not found</div>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="col-form-label">Search Engine Description: <i>(Optional)</i></label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{$article->description}}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div id="thumbnail-block" style="display: none">
                            <div class="form-group">
                                <label for="image" class="col-form-label">Thumbnail:</label>
                                <input type="file" name="thumbnail" id="thumbnail-path" class="form-control" accept="image/*" >
                            </div>
                        </div>
                        <div id="thumbnail-preview-block">
                            <div class="form-group mb-3 mb-lg-0">
                                <label for="image" class="col-form-label">Thumbnail Preview:</label>
                                <div class="float-right"><button type="button" id="thumbnail-delete" class="btn btn-danger btn-sm font-size-10"><i class="bi bi-trash"></i> Delete</button></div>
                                <div class="d-block text-center p-3 border rounded">
                                    <img id="thumbnail-preview-src" src="{{$article->thumbnail_url}}" class="rounded img-thumbnail" style="height:180px"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="thumbnail-credit" class="col-form-label">Image Source: <i>(Optional)</i></label>
                            <input type="text" class="form-control" id="thumbnail-credit" name="thumbnail_credit" value="{{$article->thumbnail_credit}}">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label for="editor-tiny-mce" class="col-form-label">Content:</label>
                    <textarea class="form-control" id="editor-tiny-mce" name="content" rows="4" required>{{$article->content}}</textarea>
                </div>
            </div>
            <div class="block-footer pt-0 px-4 pb-4 text-center">
                <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-save mr-1"></i> Save</button>
            </div>
        </form>
    </div>
@endsection
