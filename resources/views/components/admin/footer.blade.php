<footer id="page-footer" class="sticky-footer bg-white">
    <div class="container-fluid">
        <div class="row font-size-sm">
            <div class="col-12 col-lg-6 order-sm-1 py-1 text-center text-sm-left">
                &copy; <span id="year"></span> <a href="{{ config('app.url') }}" title="{{ config('app.name') }}"><strong>{{ config('app.name') }}</strong></a>. All Right Reserverd. 
            </div>
            <div class="col-12 col-lg-6 order-sm-1 py-1 text-center text-sm-right">
                {!! config('credit.handcrafted') !!}
            </div>
        </div>
    </div>
</footer>