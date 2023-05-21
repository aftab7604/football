<nav class="navbar navbar-expand-sm navbar-dark bg-dark main-nav">
    <a class="navbar-brand main-navbar-brand" href="{{route('public.fixtures')}}">
        <img src="{{asset('PublicArea/img/logo.png')}}" alt="logo" width="40%">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNav" aria-controls="mainNav"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
        <ul class="navbar-nav ml-auto mr-2">
        </ul>
        <form action="{{route('public.search.all')}}" method="GET" class="form-inline my-2 my-md-0">
            @csrf
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search" aria-label="Search"
                    aria-describedby="basic-addon2" value="{{isset($search) && $search ? $search :''}}">
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="submit">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</nav>
