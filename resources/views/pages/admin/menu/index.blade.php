@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="block block-rounded">
            <div class="block-header d-md-flex align-items-center justify-content-between py-3 border-bottom">
                <h3 class="block-title">Menu</h3>
            </div>
            <div class="block-content block-content-full py-3">            
                <div class="row">
                    <div class="col-md-4">
                        @include('components.admin.menu.left')
                    </div>
                    <div class="col-md-8">
                        @include('components.admin.menu.right')
                    </div>
                </div>
                
                <div class="ajax-loader" id="ajax_loader">
                    <div class="lds-ripple">
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extend_assets_css')
    <link rel="stylesheet" href="{{ asset('plugins/noty/noty.min.css') }}">
@endsection

@section('extend_assets_js')
    <script type="text/javascript" src="{{ asset('plugins/nestable2/jquery.nestable.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('plugins/noty/noty.min.js') }}"></script>
    <script type="text/javascript"> 
        var URL_MENU_CREATE = "{{ route('admin.super.menu.create') }}";
        var URL_MENU_DELETE = "{{ route('admin.super.menu.delete') }}";
        var URL_MENU_UPDATE = "{{ route('admin.super.menu.update') }}";
        var URL_MENU_ACTUALIZAR = "{{ route('admin.super.menu.actualizar') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
    </script>
@endsection