<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bottomNav"
        aria-controls="bottomNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="bottomNav">
        <ul class="navbar-nav">
            <li class="nav-item nav-cus">
                <a class="nav-link active" href="{{route('public.fixtures')}}">Fixtures</a>
            </li>
            <li class="nav-item nav-cus">
                <a class="nav-link active" href="{{route('public.leagues')}}">Leagues</a>
            </li>
            <li class="nav-item nav-cus">
                <a class="nav-link active" href="{{route('public.articles.all')}}">Articles</a>
            </li>
            @if (Auth::user())
            <li class="nav-item nav-cus">
                <a class="nav-link active" href="{{route('admin.index')}}">Admin</a>
            </li>
            @endif
            {{-- <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="http://example.com" id="dropdown03"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown03">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li> --}}
        </ul>
    </div>
</nav>
