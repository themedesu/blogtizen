<li data-id="{{$m['id']}}" class="dd-item mb-2 mt-2">
    <div class="card-header border-0 rounded shadow-sm">
        <span class="dd-handle rounded"><i class="bi bi-arrows-move" aria-hidden="true"></i></span>
        <span class="item-title">
            <span class="menu-item-title font-weight-bold"> 
                {{$m['label']}}
            </span>
            /
            <span class="menu-item-link font-weight-light"> 
                {{ StringText::limit($m['link'], $limit = 30) }}
            </span>
        </span>
        <div class="card-link float-lg-right mt-2 mt-lg-0" data-bs-toggle="collapse" href="#collapse{{$m['id']}}">
            <span class="item-controls"> 
                <span class="item-type badge bg-dark rounded-pill py-1 px-3" style="cursor:pointer">Option <i class="bi bi-folder2" aria-hidden="true"></i></span>
            </span>
        </div>
    </div>
    <div id="collapse{{$m['id']}}" class="collapse " data-parent="#accordion">
        <div class="card-body mt-1 bg-light rounded">
            <div class="menu-item-settings" id="menu-item-settings-{{$m['id']}}">
                <input type="hidden" class="edit-menu-item-id" name="id-menu-{{$m['id']}}" value="{{$m['id']}}" />
                <div class="form-group">
                    <label for="">Label</label>
                    <input id="label-menu-{{$m['id']}}" class="form-control font-size-14 edit-menu-item-title" 
                    name="label-menu-{{$m['id']}}" value="{{$m['label']}}">
                </div>
                <div class="form-group">
                    <label for="">Url</label>
                    <input id="url-menu-{{$m['id']}}" class="form-control font-size-14 edit-menu-item-url" 
                    name="url-menu-{{$m['id']}}" value="{{$m['link']}}">
                </div>
                <div class="form-group">
                    <label for="">Class CSS (optional)</label>
                    <input id="clases-menu-{{$m['id']}}" class="form-control font-size-14 edit-menu-item-classes" 
                    name="clases-menu-{{$m['id']}}" value="{{$m['class']}}">
                </div>
                <div class="form-group">
                    <label for="">Icon</label>
                    <input id="icon-menu-{{$m['id']}}" class="form-control font-size-14 edit-menu-item-icon" 
                    name="icon-menu-{{$m['id']}}" value="{{$m['icon']}}">
                </div>
                <div class="form-group">
                    @php
                        $target = [
                            '_self' => 'Open link directly',
                            '_blank' => 'Open link in new tab',
                        ]
                    @endphp
                    <label for="">Target</label>
                    <select name="target" class="form-control font-size-14 edit-menu-item-target" id="target-menu-{{$m['id']}}">
                        @foreach ($target as $key => $item)
                            <option value="{{$key}}" @if($key == $m['target']) selected @endif>{{$item}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group mb-0">
                    <button type="button" onclick="deleteItem({{$m['id']}})" class="btn btn-danger btn-sm me-2" 
                        id="delete-{{$m['id']}}" href="javascript:void(0)">Delete</button>
                    <button type="button" onclick="updateItem({{$m['id']}})" class="btn btn-primary btn-sm" 
                        id="update-{{$m['id']}}" href="javascript:void(0)">Update</button>
                </div>
            </div>
        </div>
    </div>
    @if (isset($m['child']) && count($m['child']) > 0)
    <ol class="dd-list">
        @foreach($m['child'] as $_m)
            @include('components.admin.menu.loop-item', ['m' => $_m, 'key' => 1])
        @endforeach
    </ol>
    @endif
</li>
