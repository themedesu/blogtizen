@extends('layouts.admin')

@section('extend_assets_css')
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.min.css') }}">
@endsection

@section('extend_assets_js')
    <script src="{{ asset('plugins/noty/noty.min.js') }}"></script>
@endsection

@section('extend_assets_js_native')
    @include('components.status')
@endsection

@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
                <h3 class="block-title">Tag <small class="font-size-13">> Edit {{$tag->name}}</small></h3>
                <a href="{{ route('admin.tag.index')}}" class="btn btn-light font-size-12"> 
                    <i class="bi bi-backspace-fill"></i> Back
                </a>
            </div> 
            <div class="block-content my-2">
                <form action="{{ route('admin.tag.update', ['tag' => $tag->id]) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="py-2 px-3 my-2 py-4">
                        <div class="row">
                            <div class="col-3">
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group mb-3">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{$tag->name}}" required>
                                </div>
                                <div class="text-center mb-3">
                                    <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-save mr-2"></i> Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
