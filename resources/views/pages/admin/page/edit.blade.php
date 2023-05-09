@extends('layouts.admin')

@section('extend_assets_css')
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.min.css') }}">
@endsection

@section('extend_assets_js')
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>
    <script src="{{ asset('plugins/tinymce/tinymce.min.js') }}"></script>
@endsection

@section('extend_assets_js_native')
    @include('components.admin.tinymce.editor')
    @include('components.status')
@endsection

@section('content')
    <div class="content">
        <div class="block block-rounded">
            <form action="{{ route('admin.page.update', ['page' => $page->id]) }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
                    <h3 class="block-title">Page <small class="font-size-13">> Edit {{$page->title_slice}}</small></h3>
                    <a href="{{ route('admin.page.index') }}" class="btn btn-light font-size-12"> 
                        <i class="bi bi-backspace-fill"></i> Back
                    </a>
                </div>
                <div class="block-content block-content-full py-4">
                    <div class="form-group mb-3">
                        <label for="title" class="col-form-label">Title:</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$page->title}}" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description" class="col-form-label">Search Engine Description: <i>(Optional)</i></label>
                        <textarea class="form-control" id="description" name="description">{{$page->description}}</textarea>
                    </div>
                    <div class="form-group mb-0">
                        <label for="editor-tiny-mce" class="col-form-label">Content:</label>
                        <textarea class="form-control" id="editor-tiny-mce" name="content" rows="4" required>{{$page->content}}</textarea>
                    </div>
                </div>
                <div class="block-footer pt-0 px-4 pb-4 text-center">
                    <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-save mr-1"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
