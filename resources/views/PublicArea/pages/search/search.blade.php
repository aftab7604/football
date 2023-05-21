@extends('PublicArea.layouts.app')
@section('title')
Football-Today
@endsection
@section('content')


<div class="row mt-3">
    <div class="col-md-12">
        <div id="league_info" class="row">
            <div class="col-md-12 mb-2">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-teams-tab" data-toggle="pill" href="#pills-teams"
                            role="tab" aria-controls="pills-teams" aria-selected="false">Teams</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-competitions-tab" data-toggle="pill" href="#pills-competitions"
                            role="tab" aria-controls="pills-competitions" aria-selected="true">Competitions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-venues-tab" data-toggle="pill" href="#pills-venues" role="tab"
                            aria-controls="pills-venues" aria-selected="false">Venues</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane active show fade" id="pills-teams" role="tabpanel"
                        aria-labelledby="pills-teams-tab">
                        {{-- Teams --}}
                        <div class="col-md-12 mb-2 px-0">
                            <div class="card align-middle bg-dark text-white">
                                <h5 class="text-left p-2">Teams</h5>
                            </div>
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-left" scope="col">Country</th>
                                                <th class="text-left" scope="col">Team</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teams as $key => $team)
                                            <tr>
                                                <th scope="row" style="width: 25% !important">
                                                    {{$key+1}}
                                                </th>
                                                <td class="text-left" style="width: 35% !important">
                                                    {{$team->team->country}}
                                                </td>
                                                <td class="text-left" style="width: 40% !important">
                                                    <a class="no-underline" href="{{route('public.team.get', [
                                                    'nation' => str_replace(' ', '_', $team->team->country),
                                                    'id' => $team->team->id,
                                                    'club' => str_replace(' ', '_', $team->team->name)]
                                                    )}}">
                                                        <img width="14%" src="{{$team->team->logo}}" alt="">
                                                        {{$team->team->name}}
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End of Teams --}}
                    </div>
                    <div class="tab-pane fade" id="pills-competitions" role="tabpanel"
                        aria-labelledby="pills-competitions-tab">
                        {{-- Competitions --}}
                        <div class="col-md-12 mb-2 px-0">
                            <div class="card align-middle bg-dark text-white">
                                <h5 class="text-left p-2">Competitions</h5>
                            </div>
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-left" scope="col">Country</th>
                                                <th class="text-left" scope="col">League / Cup</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($leagues as $key => $league)
                                            <tr>
                                                <th scope="row" style="width: 25% !important">
                                                    {{$key+1}}
                                                </th>
                                                <td class="text-left" style="width: 35% !important">
                                                    @if ($league->country->flag)
                                                    <img width="14%" src="{{$league->country->flag}}" alt="">
                                                    @endif
                                                    {{$league->country->name}}
                                                </td>
                                                <td class="text-left" style="width: 40% !important">
                                                    <a class="no-underline"
                                                        href="{{route('public.league.get', ['nation' => str_replace(' ','_', $league->country->name), 'league_name' => str_replace(' ','_', $league->league->name)])}}">
                                                        <img width="14%" src="{{$league->league->logo}}" alt="">
                                                        {{$league->league->name}}
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End of Competitions --}}
                    </div>

                    <div class="tab-pane fade" id="pills-venues" role="tabpanel" aria-labelledby="pills-venues-tab">
                        {{-- Venues --}}
                        <div class="col-md-12 mb-2 px-0">
                            <div class="card align-middle bg-dark text-white">
                                <h5 class="text-left p-2">Venues</h5>
                            </div>
                            <div class="card">
                                <div class="card-body table-responsive">
                                    <table class="table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th class="text-left" scope="col">Location</th>
                                                <th class="text-left" scope="col">Venue</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($venues as $key => $venue)
                                            <tr>
                                                <th scope="row" style="width: 25% !important">
                                                    {{$key+1}}
                                                </th>
                                                <td class="text-left" style="width: 35% !important">
                                                    {{$venue->city}}, {{$venue->country}}
                                                </td>
                                                <td class="text-left" style="width: 40% !important">
                                                    <img width="14%" src="{{$venue->image}}" alt="">
                                                    {{$venue->name}}
                                                    \ </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        {{-- End of Venues --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('.table').DataTable({
            language: {
                paginate: {
                    next: '<i class="fas fa-chevron-right"></i>',
                    previous: '<i class="fas fa-chevron-left"></i>'
                }
            },
            "bFilter": false
        });

    });

</script>
@endsection
@section('css')
<style>
    .title-band {
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url("{{asset('PublicArea/img/soccer-bg.png')}}");
        background-size: cover;
        background-position: center;
    }

    .nav-pills .nav-link {
        color: #000;
    }

    .nav-pills .nav-link.active,
    .nav-pills .show>.nav-link {
        color: #fff;
        background-color: #12e5fa;
    }

    #leagues_list {
        min-height: 65vh;
    }

    .card-header {
        background-color: rgba(0, 0, 0, .8);
    }

    #DataTables_Table_0_length {
        text-align: left !important;
    }

</style>
@endsection
