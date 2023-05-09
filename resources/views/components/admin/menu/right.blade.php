<div class="card">
    <div class="card-body">
        <div class="jumbotron jumbotron-fluid p-1 pt-3 rounded mb-3">
            <div class="container">
                <h5 class="my-2">Menu Structure</h5>
                <p class="">Place each item in the order you want. Click to the right of an item to show more configuration options</p>
            </div>
        </div>

        <div id="accordion" class="">
            @if(isset($menus) && count($menus) > 0)
                <div class="dd nestable-menu" id="nestable">
                    <ol class="dd-list">	
                        @foreach($menus as $key => $m)
                            @include('components.admin.menu.loop-item', ['key' => $key])
                        @endforeach
                    </ol>
                </div>
            @else
                <div class="alert alert-warning mb-0">Menu not found, please add first</div>
            @endif 
        </div>

    </div>
    @if(isset($menus) && count($menus) > 0)
        <div class="card-footer">
            <button type="button" class="btn btn-primary btn-sm font-size-12" 
                onclick="updateItem()" href="javascript:void(9)">Update All Item
            </button>
        </div>
    @endif
</div>