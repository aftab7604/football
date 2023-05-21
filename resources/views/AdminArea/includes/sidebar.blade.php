<aside class="left-sidebar bg-sidebar">
    <div id="sidebar" class="sidebar sidebar-with-footer">
        <!-- Aplication Brand -->
        <div class="app-brand">
            <a href="{{route('admin.index')}}">
                <img src="{{asset('PublicArea/img/logo.png')}}" alt="Logo"
                    style="width: 90%;max-width: 90%;text-align: center;">
            </a>
        </div>
        <!-- begin sidebar scrollbar -->
        <div class="sidebar-scrollbar">
            <!-- sidebar menu -->
            <ul class="nav sidebar-inner" id="sidebar-menu">
                <li class="has-sub expand {{$active_url == 'admin.index' ? 'active':''}}">
                    <a class="sidenav-item-link" href="{{route('admin.index')}}">
                        <i class="mdi mdi-view-dashboard-outline"></i>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>
                <li
                    class="has-sub expand
                    {{ in_array($active_url, ['admin.category.all', 'admin.category.add', 'admin.category.edit']) ? 'active':''}}">
                    <a class="sidenav-item-link" href="{{route('admin.category.all')}}">
                        <i class="mdi mdi-view-list"></i>
                        <span class="nav-text">Category</span>
                    </a>
                </li>
                <li
                    class="has-sub expand
                    {{ in_array($active_url, ['admin.article.all', 'admin.article.add', 'admin.article.edit']) ? 'active':''}}">
                    <a class="sidenav-item-link" href="{{route('admin.article.all')}}">
                        <i class="mdi mdi-newspaper"></i>
                        <span class="nav-text">Article</span>
                    </a>
                </li>
                <hr class="separator">
                <li class="has-sub expand">
                    <a class="sidenav-item-link" href="{{route('public.fixtures')}}">
                        <i class="mdi mdi-home"></i>
                        <span class="nav-text">Go to public site</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
