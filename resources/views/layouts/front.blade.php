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

            if (empty($metaLogo)) {
                $metaLogo = config('app.logo');
            } 
        @endphp

        <x-meta-title :metaTitle="$metaTitle"/>
        <x-meta-description :metaDescription="$metaDescription"/>

        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{url()->full()}}">
        <meta property="og:title" content="{{$metaTitle}}">
        <meta property="og:description" content="{{$metaDescription}}">
        <meta property="og:image" content="{{$metaLogo}}">

        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{url()->full()}}">
        <meta property="twitter:title" content="{{$metaTitle}}">
        <meta property="twitter:description" content="{{$metaDescription}}">
        <meta property="twitter:image" content="{{$metaLogo}}">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!-- Icons -->
        <link href="{{ config('app.url') }}/favicon.ico" rel="shortcut icon">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/bootstrap/icons/font/bootstrap-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('css/front.min.css') }}">
        
        @yield('extend_assets_css')

        <!-- Scripts -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    </head>
    <body>

        @include('components.front.header')
        @include('components.front.navbar')

        <div class="container my-5">
            @yield('content')
        </div>

        @include('components.front.footer')

        <!-- Script -->
        @yield('extend_assets_js')

        <script src="{{ asset('js/front.min.js') }}"></script> 

        @yield('extend_assets_js_native')
        
    </body>
</html>