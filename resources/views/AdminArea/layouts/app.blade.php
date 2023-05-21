<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Football-Today | Admin Area</title>
    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset('favicons/apple-icon-57x57.png')}}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{asset('favicons/apple-icon-60x60.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('favicons/apple-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('favicons/apple-icon-76x76.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('favicons/apple-icon-114x114.png')}}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{asset('favicons/apple-icon-120x120.png')}}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset('favicons/apple-icon-144x144.png')}}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{asset('favicons/apple-icon-152x152.png')}}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('favicons/apple-icon-180x180.png')}}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{asset('favicons/android-icon-192x192.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('favicons/favicon-32x32.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('favicons/favicon-96x96.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('favicons/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset('favicons/manifest.json')}}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{asset('favicons/ms-icon-144x144.png')}}">
    <meta name="theme-color" content="#ffffff">
    {{-- Keywords metatag --}}
    <meta name="keywords" content="Live football, Football scores, Football results, live football scores, todays scores, todays football
        scores, Yesturdays football scores, Tomorrow fixtures, tomorrow football fixtures, todays football fixtures,
        football fixtures, Football tables, football standings, Stats, team stats, players stats, EPL Results, football
        teams, football clubs, live soccer, Football today, todays football, latest football scores, tonights football,
        premier league result, premier league fixtures, Championship fixtures, Championship scores, league 1 fixtures,
        league 1 scores, league 2 fixtures, league 2 scores, Ligue 1 fixtures, ligue 1 scores, ligue 2 fixtures, ligue 2
        scores, budesliga scores, budesliga fixtures, Liga BBVA scores, Liga BBVA fixtures, Serie A scores, Serie A
        fixtures, Serie B scores, Serie B Fixtures, Eredivisie scores, Eredivisie fixtures, MLS Scores, MLS Fixtures,
        Scottish Premier league scores, Scottish premier league fixtures, Belgium first division scores, Belgium first
        divisions fixtures, Swiss super league scores, Swiss super league fixtures" />

    @php
    $active_url = Route::currentRouteName();
    @endphp
    @include('AdminArea.includes.css')
</head>


<body class="sidebar-fixed sidebar-dark header-light header-fixed" id="body">

    <div class="mobile-sticky-body-overlay"></div>

    <div class="wrapper">

        {{-- Sidebar --}}
        @include('AdminArea.includes.sidebar')



        <div class="page-wrapper">
            <!-- Header -->
            @include('AdminArea.includes.navbar')


            <div class="content-wrapper">
                @yield('content')
            </div>

            {{-- Footer --}}
            @include('AdminArea.includes.footer')
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade mt-5 pt-5" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Logout</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-md-6 text-center">
                            <h3>Are you sure?</h3>
                            <span>Do You Want To Logout Now?</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-pill">Sure, Logout</button>
                    </form>
                    <button type="button" class="btn btn-danger btn-pill" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    @include('AdminArea.includes.js')
</body>

</html>
