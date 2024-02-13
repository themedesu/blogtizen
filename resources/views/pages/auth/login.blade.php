@extends('layouts.auth')

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
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="block block-rounded mb-0 mt-5">
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 py-lg-5">
                            <h2 class="mb-3">
                                <span class="text-dark">{{ config('app.name') }}</span>
                            </h2>
                            <p class="text-muted">
                                Please enter login access to use the application
                            </p>
                            <form class="js-validation-signin" action="{{ route('auth.login.action') }}" method="POST">
                                {{ csrf_field() }}
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-alt" id="email" name="email" placeholder="email" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-alt" id="password" name="password" placeholder="password" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="remember" name="remember">
                                            <label class="custom-control-label font-w400" for="remember">Remember me</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn btn-block btn-dark">
                                            <i class="bi bi-box-arrow-in-right mr-1"></i> Sign In
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
