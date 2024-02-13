<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route('admin.home.index')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="bi bi-rocket-takeoff"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ SidebarRoute::isActive('admin/home') }}">
        <a class="nav-link" href="{{route('admin.home.index')}}">
            <i class="bi bi-house-door-fill"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Information
    </div>

    <li class="nav-item {{ SidebarRoute::isActive('admin/page') }}">
        <a class="nav-link" href="{{route('admin.page.index')}}">
            <i class="bi bi-file-earmark-fill"></i>
            <span>Page</span>
        </a>
    </li>

    <!-- Nav Item - Article Collapse Menu -->
    <li class="nav-item {{ SidebarRoute::isActive(['admin/article', 'admin/tag']) }}">
        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#nav-item1">
            <i class="bi bi-newspaper"></i>
            <span>Article</span>
        </a>
        <div id="nav-item1" class="collapse {{ SidebarRoute::isOpen(['admin/article', 'admin/tag']) }}">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Components</h6>
                <a class="collapse-item {{ SidebarRoute::isActive('admin/article') }}" href="{{route('admin.article.index')}}">
                    Article
                </a>
                <a class="collapse-item {{ SidebarRoute::isActive('admin/tag') }}" href="{{route('admin.tag.index')}}">
                    Tag
                </a>
            </div>
        </div>
    </li>

    @if (auth()->user()->level == 1)
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Setting
    </div>
    
    <li class="nav-item {{ SidebarRoute::isActive('admin/menu') }}">
        <a class="nav-link" href="{{route('admin.super.menu.index')}}">
            <i class="bi bi-file-earmark-fill"></i>
            <span>Menu</span>
        </a>
    </li>

    <li class="nav-item {{ SidebarRoute::isActive('admin/user') }}">
        <a class="nav-link" href="{{route('admin.super.user.index')}}">
            <i class="bi bi-people-fill"></i>
            <span>User</span>
        </a>
    </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->