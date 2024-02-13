<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <link rel="canonical" href="{{url()->full()}}" />
        
        @php
            if (empty($metaTitle)) {
                $metaTitle = config('app.name') . ' - '.config('app.slogan');
            } else {
                $metaTitle = $metaTitle . ' - ' . config('app.name');
            }

            if (empty($metaDescription)) {
                $metaDescription = config('app.desc');
            } 
        @endphp

        <x-meta-title :metaTitle="$metaTitle"/>
        <x-meta-description :metaDescription="$metaDescription"/>
        <meta name="robots" content="noindex, nofollow">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Icons -->
        <link href="{{ config('app.url') }}/favicon.ico" rel="shortcut icon">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/icons/font/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/admin.min.css') }}">

        @yield('extend_assets_css')

        <!-- Scripts -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script>window.Laravel = {!! json_encode(['csrfToken' => csrf_token(),]) !!};</script>
    </head>
    <body class="login-page">
        <div id="page-container" >
            <!-- Main Container -->
            <main id="main-container">
                @yield('content')
            </main>
            <!-- END Main Container -->
        </div>

        @yield('extend_assets_js')
        @yield('extend_assets_js_native')
        
    </body>
</html>