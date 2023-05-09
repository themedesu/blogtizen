<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 border-bottom" id="is-header-fixed">
    <div class="container">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if($dynamicMenu)
            <ul class="navbar-nav me-auto">
            @foreach($dynamicMenu as $menu)
                <li class="nav-item {{$menu['child'] ? 'dropdown' : ''}}">
                    @if( $menu['child'] )
                        <a class="nav-link fw-semibold bg-menu text-menu rounded-15 py-1 px-3 me-0 me-lg-2 mt-2 mt-lg-0 dropdown-toggle {!! $menu['class'] !!}" href="{{ $menu['link'] }}" target="{{ $menu['target'] }}" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{!! $menu['icon'] !!} {{ $menu['label'] }}</a>
                        <ul class="dropdown-menu py-3 rounded-20 border-0 shadow animate__animated animate__zoomInUp animate__faster" aria-labelledby="navbarDropdown">
                        @foreach( $menu['child'] as $child )
                            @if( $child['child'] )
                            <li>
                                <a class="dropdown-item py-2 {!! $child['class'] !!}" href="{{ $child['link'] }}" target="{{ $child['target'] }}">{!! $child['icon'] !!} {{ $child['label'] }} &raquo;</a>
                                <ul class="submenu dropdown-menu py-3 rounded-20 border-0 shadow animate__animated animate__fadeInRight animate__faster" aria-labelledby="navbarDropdown">
                                @foreach( $child['child'] as $child )
                                    <li><a class="dropdown-item py-2 {!! $child['class'] !!}" href="{{ $child['link'] }}" target="{{ $child['target'] }}">{!! $child['icon'] !!} {{ $child['label'] }}</a></li>
                                @endforeach
                                </ul>
                            </li>
                            @else
                            <li>
                                <a class="dropdown-item py-2 {!! $child['class'] !!}" href="{{ $child['link'] }}" target="{{ $child['target'] }}">{!! $child['icon'] !!} {{ $child['label'] }}</a>
                            </li>
                            @endif
                        @endforeach
                        </ul>
                    @else
                        <a class="nav-link fw-semibold bg-menu text-menu rounded-15 py-1 px-3 me-0 me-lg-2 mt-2 mt-lg-0 {!! $menu['class'] !!}" href="{{ $menu['link'] }}" target="{{ $menu['target'] }}">{!! $menu['icon'] !!} {{ $menu['label'] }}</a>
                    @endif
                </li>
            @endforeach
            </ul>
        @endif
      </div>
    </div>
</nav>