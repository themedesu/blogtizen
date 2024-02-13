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
    <div class="block block-rounded">
        <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
            <h3 class="block-title">User <small class="font-size-13">> Edit {{$user->name}}</small></h3>
            <a href="{{ route('admin.super.user.index')}}" class="btn btn-light font-size-12"> 
                <i class="bi bi-backspace-fill"></i> Back
            </a>
        </div> 
        <div class="block-content my-2">
            <form action="{{ route('admin.super.user.update', ['user' => $user->id]) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="py-2 px-3 my-2 py-4">
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="email" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-2">
                                <label for="level" class="col-form-label">Level:</label>
                                <select class="form-control" id="level" name="level">
                                    <option value="1" {{$user->level === 1 ? 'selected' : ''}}>SuperAdmin</option>
                                    <option value="2" {{$user->level === 2 ? 'selected' : ''}}>Admin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-3">
                                <label for="password" class="col-form-label">Password: <span class="ml-1"><small>(Leave blank if you don't want to change)</small></span></label>
                                <input type="password" class="form-control" id="password" value="" name="password_new">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="password-confirmation" class="col-form-label">Password Confirmation:</label>
                                <input type="password" class="form-control" id="password-confirmation" value="" name="password_new_confirmation">
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-sm px-3"><i class="bi bi-save mr-2"></i> Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
