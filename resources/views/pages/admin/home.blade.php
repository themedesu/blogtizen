@extends('layouts.admin')

@section('content')
    <!-- Hero -->
    <div class="p-3 mb-4">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2 text-center text-sm-left">
            <div class="flex-sm-fill"> 
                <h2 class="fw-bold mb-2">
                    {{ StringText::greeting('!') }}
                </h2>
                <span class="text-muted mb-0">
                    Welcome <span class="fw-bold">{{(auth()->user()->name)}}</span>, everything looks great.
                </span>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="block">
                    <div class="block-header">
                      <h4 class="block-title">
                        Visitors
                      </h4>
                    </div>
                    <div class="block-content">
                        Last 10 days visit
                        <canvas class="mt-3" id="visitor"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="block">
                  <div class="block-header">
                    <h4 class="block-title">
                      Popular Article
                    </h4>
                  </div>
                  <div class="block-content">
                    This month's popular articles
                    @forelse ($articlePopulars as $article)
                        <div class="row my-2 pt-2">
                            <div class="col-3">
                                <img src="{{$article->thumbnail_url}}" class="img-thumbnail p-0" style="width: 100%; height: 50px">
                            </div>
                            <div class="col-9 ps-0">
                                <a href="{{$article->url}}" class="text-dark d-block fw-bold">{{$article->title_slice}}</a>
                                <span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-dark text-white font-size-10">{{$article->hits}}x Visits</span>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-warning mb-0 mt-3">Popular articles not found</div>
                    @endforelse
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('extend_assets_js')
    <script src="{{ asset('plugins/chart.js/chart.umd.min.js') }}"></script>
@endsection

@section('extend_assets_js_native')
    <script type="text/javascript">
        const visitors = @json($visitors);
        new Chart(
            document.getElementById('visitor'),
            {
                type: 'bar',
                data: {
                    labels: visitors.map(row => row.date),
                    datasets: [
                        {
                            label: 'Total',
                            data: visitors.map(row => row.total),
                            borderColor: '#5a5c69',
                            backgroundColor: '#5a5c69',
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            }
        );
    </script>
@endsection