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
        })
    </script>

    @include('components.admin.tinymce.editor')
    @include('components.status')
@endsection

@section('content')
    <div class="block block-rounded">
        <form action="{{ route('admin.article.store') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
                <h3 class="block-title">Article <small class="font-size-13">> Add</small></h3>
                <a href="{{ route('admin.article.index') }}" class="btn btn-light font-size-12"> 
                    <i class="bi bi-backspace-fill"></i> Back
                </a>
            </div>
            <div class="block-content block-content-full py-3">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="form-group mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="tags" class="col-form-label">Tag:</label>
                            <select class="form-control" id="tags" name="tags[]" multiple="multiple">
                                @forelse ($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @empty
                                    <div>Tag not found</div>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description" class="col-form-label">Search Engine Description: <i>(Optional)</i></label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="form-group mb-3">
                            <label for="thumbnail" class="col-form-label">Thumbnail:</label>
                            <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                        </div>
                        <div class="form-group mb-3">
                            <label for="thumbnail-credit" class="col-form-label">Image Source: <i>(Optional)</i></label>
                            <input type="text" class="form-control" id="thumbnail-credit" name="thumbnail_credit">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0">
                    <label for="content" class="col-form-label">Content:</label>
                    <textarea class="form-control" id="editor-tiny-mce" name="content" rows="4" required></textarea>
                </div>
            </div>
            <div class="block-footer pt-0 px-4 pb-4 text-center">
                <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-send-plus-fill mr-1"></i> Publish</button>
            </div>
        </form>
    </div>
@endsection
