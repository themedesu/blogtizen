@php
    $metaTitle = '404: Page Not Found';
@endphp

@extends('layouts.front')

@section('content')
    <div class="py-5 text-center text-theme">
        <i class="bi bi-emoji-frown-fill d-block mb-4" style="font-size: 12rem;line-height:1"></i>
        <h2>404: Page Not Found</h2>
        <p>The page you are looking for could not be found</p>
    </div>
@endsection