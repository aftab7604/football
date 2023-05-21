<div class="col-md-12 mb-2">
    <div class="card align-middle title-band text-white">
        <h4 class="text-left px-2 py-4 text-uppercase">{{$teams->home->name}} VS {{$teams->away->name}}</h4>
    </div>
</div>
<div class="col-md-12 mb-2">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="pills-match-preview-tab" data-toggle="pill" href="#pills-match-preview" role="tab"
                aria-controls="pills-match-preview" aria-selected="true">Match Preview</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-fixtures-tab" data-toggle="pill" href="#pills-lineups" role="tab"
                aria-controls="pills-lineups" aria-selected="false">Lineups</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-match-stats-tab" data-toggle="pill" href="#pills-match-stats" role="tab"
                aria-controls="pills-match-stats" aria-selected="false">Match Statistics</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade" id="pills-match-preview" role="tabpanel" aria-labelledby="pills-match-preview-tab">
            <div class="row">
                {{-- info --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Info</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-3 text-center mobile-resp">
                                    <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $teams->home->id,
                                'club' => str_replace(' ', '_', $teams->home->name)]
                                )}}">
                                        <div>
                                            <img class="team-logo" src="{{$teams->home->logo}}" alt="home">
                                        </div>
                                        <h4 class="mt-2 team-text">{{$teams->home->name}}</h4>
                                    </a>
                                </div>
                                <div class="col-md-3 text-center mobile-resp">
                                    <div>
                                        <h3 class="time-text">
                                            @switch($fixture->status->short)
                                            @case("1H")
                                            {{$fixture->status->elapsed}}'
                                            @break
                                            @case("2H")
                                            {{$fixture->status->elapsed}}'
                                            @break
                                            @case("ET")
                                            {{$fixture->status->elapsed}}'
                                            @break
                                            @default
                                            {{$fixture->status->short}}
                                            @endswitch
                                        </h3>
                                    </div>
                                    <h4 class="score-text">{{$goals->home}} - {{$goals->away}}</h4>
                                </div>
                                <div class="col-md-3 text-center mobile-resp">
                                    <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $teams->away->id,
                                'club' => str_replace(' ', '_', $teams->away->name)]
                                )}}">
                                        <div>
                                            <img class="team-logo" src="{{$teams->away->logo}}" alt="away">
                                        </div>
                                        <h4 class="mt-2 team-text">{{$teams->away->name}}</h4>
                                    </a>
                                </div>
                                <div class="col-md-9 mt-2">
                                    {{\carbon\carbon::parse($fixture->timestamp)->setTimezone($timezone)->format('d/m/Y')}}
                                    |
                                    <a class="no-underline"
                                        href="{{route('public.league.get', ['nation' => str_replace(' ','_', $league->country), 'league_name' => str_replace(' ','_', $league->name)])}}">{{$league->name}}</a>
                                    |
                                    KickOff
                                    {{\carbon\carbon::parse($fixture->timestamp)->setTimezone($timezone)->format('H:i')}}
                                </div>
                                <div class="col-md-9">
                                    <span>Venue - {{$fixture->venue->name}}</span>
                                    <hr>
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mx-auto">
                                        <tbody>
                                            @php
                                            $home_goals = 0;
                                            $away_goals = 0;
                                            @endphp
                                            @foreach ($events as $key => $event)

                                            @if (in_array($event->detail, ['Normal Goal', 'Own Goal', 'Penalty']))

                                            @php
                                            if ($event->team->id == $teams->home->id) {
                                            $home_goals++;
                                            } else {
                                            $away_goals++;
                                            }
                                            @endphp

                                            <tr>
                                                <td class="text-right scorer-name">
                                                    @if ($event->team->id == $teams->home->id)
                                                    <a class="player_link" href="">
                                                        {{$event->player->name}}
                                                    </a>
                                                    <span class="minute">
                                                        {{$event->time->elapsed}}'&nbsp;&nbsp;<i
                                                            class="far fa-futbol"></i>
                                                    </span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <span class="score">
                                                        {{$home_goals}}&nbsp;-&nbsp;{{$away_goals}}
                                                    </span>
                                                </td>
                                                <td class="text-left scorer-name">
                                                    @if ($event->team->id == $teams->away->id)
                                                    <span class="scorer">
                                                        <span class="minute">
                                                            <i
                                                                class="far fa-futbol"></i>&nbsp;&nbsp;{{$event->time->elapsed}}'
                                                        </span>
                                                        <a class="player_link" href="">
                                                            {{$event->player->name}}
                                                        </a>
                                                    </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of info --}}
                {{-- recent form --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Previous Fixtures</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-3 text-left">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body table-responsive">
                                            <h6 class="card-title">{{$teams->home->name}}</h6>
                                            <table class="table" style="width: 100%;">
                                                <tbody>
                                                    @forelse ($form["home"] as $home_fixture)
                                                    <tr class="thead-light">
                                                        <th colspan="5">
                                                            {{\carbon\carbon::parse($home_fixture->fixture->timestamp)->setTimezone($timezone)->format('d/m/Y')}}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="width: 15%">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $home_fixture->teams->home->id,
                                                                'club' => str_replace(' ', '_', $home_fixture->teams->home->name)
                                                            ])}}">
                                                                <img class="team-logo-h2h"
                                                                    src="{{$home_fixture->teams->home->logo}}"
                                                                    alt="home">
                                                            </a>
                                                        </td>
                                                        <td class="text-left">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $home_fixture->teams->home->id,
                                                                'club' => str_replace(' ', '_', $home_fixture->teams->home->name)
                                                            ])}}">
                                                                {{$home_fixture->teams->home->name}}
                                                            </a>
                                                        </td>
                                                        <td style="white-space: nowrap">
                                                            {{$home_fixture->goals->home}}-{{$home_fixture->goals->away}}
                                                        </td>
                                                        <td class="text-right">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $home_fixture->teams->away->id,
                                                                'club' => str_replace(' ', '_', $home_fixture->teams->away->name)
                                                            ])}}">
                                                                {{$home_fixture->teams->away->name}}
                                                            </a>
                                                        </td>
                                                        <td class="text-right" style="width: 15%">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $home_fixture->teams->away->id,
                                                                'club' => str_replace(' ', '_', $home_fixture->teams->away->name)
                                                            ])}}">
                                                                <img class="team-logo-h2h"
                                                                    src="{{$home_fixture->teams->away->logo}}"
                                                                    alt="home">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            No data available
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->away->name}}</h6>
                                            <table class="table" style="width: 100%;">
                                                <tbody>
                                                    @forelse ($form["away"] as $away_fixture)
                                                    <tr class="thead-light">
                                                        <th colspan="5">
                                                            {{\carbon\carbon::parse($away_fixture->fixture->timestamp)->setTimezone($timezone)->format('d/m/Y')}}
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-left" style="width: 15%">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $away_fixture->teams->home->id,
                                                                'club' => str_replace(' ', '_', $away_fixture->teams->home->name)
                                                            ])}}">
                                                                <img class="team-logo-h2h"
                                                                    src="{{$away_fixture->teams->home->logo}}"
                                                                    alt="home">
                                                            </a>
                                                        </td>
                                                        <td class="text-left">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $away_fixture->teams->home->id,
                                                                'club' => str_replace(' ', '_', $away_fixture->teams->home->name)
                                                            ])}}">
                                                                {{$away_fixture->teams->home->name}}
                                                            </a>
                                                        </td>
                                                        <td style="white-space: nowrap">
                                                            {{$away_fixture->goals->home}}-{{$away_fixture->goals->away}}
                                                        </td>
                                                        <td class="text-right">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $away_fixture->teams->away->id,
                                                                'club' => str_replace(' ', '_', $away_fixture->teams->away->name)
                                                            ])}}">
                                                                {{$away_fixture->teams->away->name}}
                                                            </a>
                                                        </td>
                                                        <td class="text-right" style="width: 15%">
                                                            <a class="no-underline" href="{{route('public.team.get', [
                                                                'nation' => str_replace(' ', '_', $league->country),
                                                                'id' => $away_fixture->teams->away->id,
                                                                'club' => str_replace(' ', '_', $away_fixture->teams->away->name)
                                                            ])}}">
                                                                <img class="team-logo-h2h"
                                                                    src="{{$away_fixture->teams->away->logo}}"
                                                                    alt="home">
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @empty
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            No data available
                                                        </td>
                                                    </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end of recent form --}}
                {{-- team stats --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Team Statistics</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row my-3 text-left">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->home->name}} Goals</h6>
                                            <small class="card-text my-2">
                                                {{$teams->home->name}} have scored
                                                <strong>{{$team_statistics['home']->goals->for->total->total}}</strong>
                                                goals from
                                                <strong>{{$team_statistics['home']->fixtures->played->total}}</strong>
                                                matches. This gives
                                                us an
                                                average of
                                                <strong>{{$team_statistics['home']->goals->for->average->total}}</strong>
                                                total
                                                goals scored. {{$teams->home->name}} have conceded
                                                <strong>{{$team_statistics['home']->goals->against->total->total}}</strong>
                                                goals
                                                which works out an average of
                                                <strong>{{$team_statistics['home']->goals->against->average->total}}</strong>
                                                goals
                                                conceded per match.
                                            </small>
                                            <canvas id="home_goals_bar" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->away->name}} Goals</h6>
                                            <small class="card-text my-2">
                                                {{$teams->away->name}} have scored
                                                <strong>{{$team_statistics['away']->goals->for->total->total}}</strong>
                                                goals from
                                                <strong>{{$team_statistics['away']->fixtures->played->total}}</strong>
                                                matches. This gives
                                                us an
                                                average of
                                                <strong>{{$team_statistics['away']->goals->for->average->total}}</strong>
                                                total
                                                goals scored. {{$teams->away->name}} have conceded
                                                <strong>{{$team_statistics['away']->goals->against->total->total}}</strong>
                                                goals
                                                which works out an average of
                                                <strong>{{$team_statistics['away']->goals->against->average->total}}</strong>
                                                goals
                                                conceded per match.
                                            </small>
                                            <canvas id="away_goals_bar" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row my-3 text-left">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->home->name}} Home Goals</h6>
                                            <small class="card-text my-2">
                                                {{$teams->home->name}} have scored
                                                <strong>{{$team_statistics['home']->goals->for->total->home}}</strong>
                                                goals from
                                                <strong>{{$team_statistics['home']->fixtures->played->home}}</strong>
                                                home matches. This gives
                                                us an
                                                average of
                                                <strong>{{$team_statistics['home']->goals->for->average->home}}</strong>
                                                home goals scored. {{$teams->home->name}} have conceded
                                                <strong>{{$team_statistics['home']->goals->against->total->home}}</strong>
                                                goals
                                                which works out an average of
                                                <strong>{{$team_statistics['home']->goals->against->average->home}}</strong>
                                                goals
                                                conceded per match.
                                            </small>
                                            <canvas id="h_home_goals_bar" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->away->name}} Away Goals</h6>
                                            <small class="card-text my-2">
                                                {{$teams->away->name}} have scored
                                                <strong>{{$team_statistics['away']->goals->for->total->away}}</strong>
                                                goals from
                                                <strong>{{$team_statistics['away']->fixtures->played->away}}</strong>
                                                away matches. This gives
                                                us an
                                                average of
                                                <strong>{{$team_statistics['away']->goals->for->average->away}}</strong>
                                                away goals scored. {{$teams->away->name}} have conceded
                                                <strong>{{$team_statistics['away']->goals->against->total->away}}</strong>
                                                goals
                                                which works out an average of
                                                <strong>{{$team_statistics['away']->goals->against->average->away}}</strong>
                                                goals
                                                conceded per match.
                                            </small>
                                            <canvas id="a_away_goals_bar" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-left">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->home->name}} Results</h6>
                                            <small class="card-text my-2">
                                                {{$teams->home->name}} have won
                                                <strong>{{$team_statistics['home']->fixtures->wins->total}}</strong>
                                                matches drawn
                                                <strong>{{$team_statistics['home']->fixtures->draws->total}}</strong>
                                                and
                                                lost
                                                <strong>{{$team_statistics['home']->fixtures->loses->total}}</strong>
                                                from
                                                <strong>{{$team_statistics['home']->fixtures->played->total}}</strong>
                                                matches.
                                            </small>
                                            <canvas id="h_home_res_pie" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->away->name}} Results</h6>
                                            <small class="card-text my-2">
                                                {{$teams->away->name}} have won
                                                <strong>{{$team_statistics['away']->fixtures->wins->total}}</strong>
                                                matches drawn
                                                <strong>{{$team_statistics['away']->fixtures->draws->total}}</strong>
                                                and
                                                lost
                                                <strong>{{$team_statistics['away']->fixtures->loses->total}}</strong>
                                                from
                                                <strong>{{$team_statistics['away']->fixtures->played->total}}</strong>
                                                matches.
                                            </small>
                                            <canvas id="a_away_res_pie" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row text-left">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->home->name}} Home Results</h6>
                                            <small class="card-text my-2">
                                                {{$teams->home->name}} have won
                                                <strong>{{$team_statistics['home']->fixtures->wins->home}}</strong>
                                                matches drawn
                                                <strong>{{$team_statistics['home']->fixtures->draws->home}}</strong> and
                                                lost
                                                <strong>{{$team_statistics['home']->fixtures->loses->home}}</strong>
                                                matches at home.
                                            </small>
                                            <canvas id="home_res_pie" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <h6 class="card-title">{{$teams->away->name}} Away Results</h6>
                                            <small class="card-text my-2">
                                                {{$teams->away->name}} have won
                                                <strong>{{$team_statistics['away']->fixtures->wins->away}}</strong>
                                                matches drawn
                                                <strong>{{$team_statistics['away']->fixtures->draws->away}}</strong> and
                                                lost
                                                <strong>{{$team_statistics['away']->fixtures->loses->away}}</strong>
                                                matches away.
                                            </small>
                                            <canvas id="away_res_pie" class="mt-2"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of team stats --}}
                {{-- h2h --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Head To Head</h5>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="h2h_table table" style="width: 100%;">
                                <tbody>
                                    @forelse ($h2h as $h2h_single)
                                    <tr class="thead-light">
                                        <th colspan="5">
                                            {{\carbon\carbon::parse($h2h_single->fixture->timestamp)->setTimezone($timezone)->format('d/m/Y')}}
                                        </th>
                                    </tr>
                                    <tr>
                                        <td class="text-left" style="width: 15%">
                                            <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $h2h_single->teams->home->id,
                                'club' => str_replace(' ', '_', $h2h_single->teams->home->name)]
                                )}}">
                                                <img class="team-logo-h2h" src="{{$h2h_single->teams->home->logo}}"
                                                    alt="home">
                                            </a>
                                        </td>
                                        <td class="text-left">
                                            <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $h2h_single->teams->home->id,
                                'club' => str_replace(' ', '_', $h2h_single->teams->home->name)]
                                )}}">
                                                {{$h2h_single->teams->home->name}}
                                            </a>
                                        </td>
                                        <td style="white-space: nowrap">
                                            {{$h2h_single->goals->home}}-{{$h2h_single->goals->away}}
                                        </td>
                                        <td class="text-right">
                                            <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $h2h_single->teams->away->id,
                                'club' => str_replace(' ', '_', $h2h_single->teams->away->name)]
                                )}}">
                                                {{$h2h_single->teams->away->name}}
                                            </a>
                                        </td>
                                        <td class="text-right" style="width: 15%">
                                            <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country),
                                'id' => $h2h_single->teams->away->id,
                                'club' => str_replace(' ', '_', $h2h_single->teams->away->name)]
                                )}}">
                                                <img class="team-logo-h2h" src="{{$h2h_single->teams->away->logo}}"
                                                    alt="home">
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">
                                            No data available
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End of h2h --}}
                {{-- league table --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Table</h5>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            @forelse ($standings as $single_standing)
                            <div class="table-responsive">
                                <table class="table">
                                    <caption style="caption-side: top">{{$single_standing[0]->group}}</caption>
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-left" scope="col">Team</th>
                                            <th class="text-center" scope="col">MP</th>
                                            <th class="text-center" scope="col">W</th>
                                            <th class="text-center" scope="col">D</th>
                                            <th class="text-center" scope="col">L</th>
                                            <th class="text-center" scope="col">F</th>
                                            <th class="text-center" scope="col">A</th>
                                            <th class="text-center" scope="col">D</th>
                                            <th class="text-center" scope="col">P</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($single_standing as $standing)
                                        <tr
                                            class="{{$standing->team->id ==  $teams->home->id? 'table-primary':($standing->team->id ==  $teams->away->id? 'table-danger':'')}}">
                                            <td>
                                                {{$standing->rank}}
                                            </td>
                                            <td class="text-left" style="white-space: nowrap;">
                                                <a class="no-underline" href="{{route('public.team.get', [
                                            'nation' => str_replace(' ', '_', $league->country),
                                            'id' => $standing->team->id,
                                            'club' => str_replace(' ', '_', $standing->team->name)]
                                            )}}">
                                                    <img class="team-logo-standing" src="{{$standing->team->logo}}"
                                                        alt="">
                                                    <span class="team-title">{{$standing->team->name}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{$standing->all->played}}
                                            </td>
                                            <td>
                                                {{$standing->all->win}}
                                            </td>
                                            <td>
                                                {{$standing->all->draw}}
                                            </td>
                                            <td>
                                                {{$standing->all->lose}}
                                            </td>
                                            <td>
                                                {{$standing->all->goals->for}}
                                            </td>
                                            <td>
                                                {{$standing->all->goals->against}}
                                            </td>
                                            <td>
                                                {{$standing->goalsDiff}}
                                            </td>
                                            <td style="font-weight: bold">
                                                {{$standing->points}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10">
                                                No information Available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @empty
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th class="text-left" scope="col">Team</th>
                                        <th class="text-center" scope="col">MP</th>
                                        <th class="text-center" scope="col">W</th>
                                        <th class="text-center" scope="col">D</th>
                                        <th class="text-center" scope="col">L</th>
                                        <th class="text-center" scope="col">F</th>
                                        <th class="text-center" scope="col">A</th>
                                        <th class="text-center" scope="col">D</th>
                                        <th class="text-center" scope="col">P</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="10">
                                            No information Available
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @endforelse
                        </div>
                    </div>
                </div>
                {{-- End of league table --}}
                {{-- predictions --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Predictions</h5>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row">
                                <div class="col-md-6">
                                    <canvas id="predictionChart"></canvas>
                                </div>
                                <div class="col-md-6">
                                    <table class="table" style="width: 100%;">
                                        <thead>
                                            <th>
                                                {{$teams->home->name}}
                                            </th>
                                            <th></th>
                                            <th>
                                                {{$teams->away->name}}
                                            </th>
                                        </thead>
                                        <tbody>
                                            @php
                                            $text_array = ['form' => 'Strength',
                                            'att' => 'Attacking Potential',
                                            'def' => 'Defensive Potential',
                                            'poisson_distribution' => 'Poisson Distribution',
                                            'h2h' => 'Strength H2H',
                                            'goals' => 'Goals H2H',
                                            'total' => 'Wins the Game'
                                            ];
                                            @endphp
                                            @foreach ($predictions['predictions'][0]->comparison as $key => $comparison)
                                            <tr>
                                                <td class="text-center">
                                                    <span class="badge badge-newinfo">{{$comparison->home}}</span>
                                                </td>
                                                <td class="text-center">
                                                    {{$text_array[$key]}}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-danger">{{$comparison->away}}</span>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End of predictions --}}
            </div>

        </div>
        <div class="tab-pane fade" id="pills-match-stats" role="tabpanel" aria-labelledby="pills-match-stats-tab">
            <div class="row">
                {{-- Events --}}
                <div class="col-md-6 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Events</h5>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table table-sm" style="width: 100%;">
                                <tbody>
                                    @if (!empty($events))

                                    @php
                                    $home_goals = 0;
                                    $away_goals = 0;
                                    @endphp

                                    @foreach ($events as $event)
                                    @php
                                    if (in_array($event->detail, ['Normal Goal', 'Own Goal', 'Penalty'])) {
                                    if($event->team->id == $teams->home->id){
                                    $home_goals++;
                                    } else {
                                    $away_goals++;
                                    }
                                    }
                                    @endphp

                                    @switch($event->type)

                                    @case("Goal")
                                    @if ($event->detail != "Missed Penalty")
                                    <tr>
                                        @if ($event->team->id == $teams->home->id)
                                        <td class="text-left">
                                            <span style="display: inline-block">
                                                <i class="far fa-futbol text-success"></i>&nbsp;
                                                <span
                                                    class="text-xs
                                        text-muted">{{$event->time->elapsed}}'</span>&nbsp;<strong>{{$home_goals}}-{{$away_goals}}</strong>&nbsp;{{$event->player->name}}&nbsp;
                                                <small class="text-xs text-muted">
                                                    @if ($event->assist->name)
                                                    Assit: {{$event->assist->name}}
                                                    @endif
                                                </small>
                                            </span>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <span style="display: inline-block">
                                                <small class="text-xs text-muted">
                                                    @if ($event->assist->name)
                                                    Assit: {{$event->assist->name}}
                                                    @endif
                                                </small>&nbsp;{{$event->player->name}}&nbsp;
                                                <strong>{{$home_goals}}-{{$away_goals}}</strong>&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                <i class="far fa-futbol text-success"></i>
                                            </span>
                                        </td>
                                        @endif
                                    </tr>
                                    @endif
                                    @break

                                    @case("Card")
                                    <tr>
                                        {{-- inside switch --}}
                                        @switch($event->detail)
                                        @case("Yellow Card")
                                        @if ($event->team->id == $teams->home->id)
                                        <td class="text-left">
                                            <span style="display: inline-block">
                                                <svg width="13" height="18">
                                                    <rect width="300" height="100" style="fill:#ffc107" />
                                                </svg>&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                {{$event->player->name}}
                                            </span>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <span style="display: inline-block">
                                                {{$event->player->name}}&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                <svg width="13" height="18">
                                                    <rect width="300" height="100" style="fill:#ffc107" />
                                                </svg>
                                            </span>
                                        </td>
                                        @endif
                                        @break
                                        @case("Red card")
                                        @if ($event->team->id == $teams->home->id)
                                        <td class="text-left">
                                            <span style="display: inline-block">
                                                <svg width="13" height="18">
                                                    <rect width="300" height="100" style="fill:#dc3545" />
                                                </svg>&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                {{$event->player->name}}
                                            </span>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <span style="display: inline-block">
                                                {{$event->player->name}}&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                <svg width="13" height="18">
                                                    <rect width="300" height="100" style="fill:#dc3545" />
                                                </svg>
                                            </span>
                                        </td>
                                        @endif
                                        @break
                                        @case("Second Yellow card")
                                        @if ($event->team->id == $teams->home->id)
                                        <td class="text-left">
                                            <span style="display: inline-block">
                                                <svg width="16" height="16" viewBox="180 180 680 680" fill="#404040"
                                                    style="min-width: 16px; display: inline-block;">
                                                    <title>2nd Yellow card (Red)</title>
                                                    <path fill="#ecaa02" d="M243.2 275.2h428.8v588.8h-428.8v-588.8z">
                                                    </path>
                                                    <path fill="#a72018" d="M352 160h428.8v588.8h-428.8v-588.8z"></path>
                                                </svg>&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                {{$event->player->name}}
                                            </span>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <span style="display: inline-block">
                                                {{$event->player->name}}&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                <svg width="16" height="16" viewBox="180 180 680 680" fill="#404040"
                                                    style="min-width: 16px; display: inline-block;">
                                                    <title>2nd Yellow card (Red)</title>
                                                    <path fill="#ecaa02" d="M243.2 275.2h428.8v588.8h-428.8v-588.8z">
                                                    </path>
                                                    <path fill="#a72018" d="M352 160h428.8v588.8h-428.8v-588.8z"></path>
                                                </svg>
                                            </span>
                                        </td>
                                        @endif
                                        @break
                                        @default
                                        @endswitch
                                        {{-- end inside switch --}}
                                    </tr>
                                    @break

                                    @case("subst")
                                    <tr>
                                        @if ($event->team->id == $teams->home->id)
                                        <td class="text-left">
                                            <span style="display: inline-block">
                                                <i class="fas fa-exchange-alt text-newinfo"></i>&nbsp;
                                                <span
                                                    class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;{{$event->player->name}}&nbsp;
                                                <small class="text-xs text-muted">Out: {{$event->assist->name}}</small>
                                            </span>
                                        </td>
                                        @else
                                        <td class="text-right">
                                            <span style="display: inline-block">
                                                <small class="text-xs text-muted">Out:
                                                    {{$event->assist->name}}</small>&nbsp;{{$event->player->name}}&nbsp;
                                                <span class="text-xs text-muted">{{$event->time->elapsed}}'</span>&nbsp;
                                                <i class="fas fa-exchange-alt text-newinfo"></i>
                                            </span>
                                        </td>
                                        @endif
                                    </tr>
                                    @break

                                    @default
                                    @endswitch

                                    @endforeach

                                    @else
                                    <tr>
                                        <td class="text-center">
                                            No data available
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End of Events --}}
                {{-- match stats --}}
                <div class="col-md-6 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Match Statistics</h5>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table" style="width: 100%;">
                                <thead>
                                    <th>
                                        {{$teams->home->name}}
                                    </th>
                                    <th></th>
                                    <th>
                                        {{$teams->away->name}}
                                    </th>
                                </thead>
                                <tbody>
                                    @if (!empty($match_statistics))
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[9]->value ? $match_statistics[0]->statistics[9]->value : '0%'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Posession</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[9]->value ? $match_statistics[1]->statistics[9]->value : '0%'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[13]->value ? $match_statistics[0]->statistics[13]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Total passes</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[13]->value ? $match_statistics[1]->statistics[13]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[2]->value ? $match_statistics[0]->statistics[2]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Total shots</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[2]->value ? $match_statistics[1]->statistics[2]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[0]->value ? $match_statistics[0]->statistics[0]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Shots on target</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[0]->value ? $match_statistics[1]->statistics[0]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[1]->value ? $match_statistics[0]->statistics[1]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Shots off target</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[1]->value ? $match_statistics[1]->statistics[1]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[7]->value ? $match_statistics[0]->statistics[7]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Corner kicks</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[7]->value ? $match_statistics[1]->statistics[7]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[8]->value ? $match_statistics[0]->statistics[8]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Offsides</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[8]->value ? $match_statistics[1]->statistics[8]->value :'0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[6]->value ? $match_statistics[0]->statistics[6]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Fouls</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[6]->value ? $match_statistics[1]->statistics[6]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[10]->value ? $match_statistics[0]->statistics[10]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Yellow cards</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[10]->value ? $match_statistics[1]->statistics[10]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[11]->value ? $match_statistics[0]->statistics[11]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Red cards</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[11]->value ? $match_statistics[1]->statistics[11]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-newinfo">
                                                {{$match_statistics[0]->statistics[12]->value ? $match_statistics[0]->statistics[12]->value : '0'}}
                                            </span>
                                        </td>
                                        <td class="text-center">Goalkeeper saves</td>
                                        <td class="text-center">
                                            <span class="badge badge-danger">
                                                {{$match_statistics[1]->statistics[12]->value ? $match_statistics[1]->statistics[12]->value : '0'}}
                                            </span>
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            No data available
                                        </td>
                                    </tr>
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End of match stats --}}
            </div>
        </div>
        <div class="tab-pane fade" id="pills-lineups" role="tabpanel" aria-labelledby="pills-lineups-tab">
            <div class="row">
                {{-- Lineups --}}
                <div class="col-md-12 mb-2">
                    <div class="card align-middle bg-dark text-white">
                        <h5 class="text-left p-2">Lineups</h5>
                    </div>
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table class="table" style="width: 100%;">
                                <thead>
                                    <th colspan="2" style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">
                                        {{$teams->home->name}} | {{!empty($lineups) ? $lineups[0]->formation : '-'}}
                                    </th>
                                    <th colspan="2" style="width:50%">
                                        {{$teams->away->name}} | {{!empty($lineups) ? $lineups[1]->formation : '-'}}
                                    </th>
                                </thead>
                                <tbody>
                                    @if (!empty($lineups))
                                    {{-- Starting XI --}}
                                    <tr class="thead-light">
                                        <th colspan="2" class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">Starting
                                            XI</th>
                                        <th colspan="2" class="text-left">Starting XI</th>
                                    </tr>
                                    @foreach ($lineups[0]->startXI as $key => $startXI)
                                    <tr>
                                        <td>{{$lineups[0]->startXI[$key]->player->number}}</td>
                                        <td class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">
                                            {{$lineups[0]->startXI[$key]->player->name}}
                                        </td>
                                        <td>{{$lineups[1]->startXI[$key]->player->number}}</td>
                                        <td class="text-left">
                                            {{$lineups[1]->startXI[$key]->player->name}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    {{-- Substitutes --}}
                                    <tr class="thead-light">
                                        <th colspan="2" class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">
                                            Substitutes</th>
                                        <th colspan="2" class="text-left">Substitutes</th>
                                    </tr>
                                    @foreach ($lineups[0]->substitutes as $key => $subs)
                                    <tr>
                                        <td>{{$lineups[0]->substitutes[$key]->player->number}}</td>
                                        <td class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">
                                            {{$lineups[0]->substitutes[$key]->player->name}}
                                        </td>
                                        <td>
                                            @if (isset($lineups[1]->substitutes[$key]))
                                            {{$lineups[1]->substitutes[$key]->player->number}}
                                            @endif
                                        </td>
                                        <td class="text-left">
                                            @if (isset($lineups[1]->substitutes[$key]))
                                            {{$lineups[1]->substitutes[$key]->player->name}}
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr class="thead-light">
                                        <th colspan="2" class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">Coach
                                        </th>
                                        <th colspan="2" class="text-left">Coach</th>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-left"
                                            style="border-right: 28px solid rgb(96 96 96 / 28%);width:50%">
                                            {{$lineups[0]->coach->name}}
                                        </td>
                                        <td colspan="2" class="text-left">
                                            {{$lineups[1]->coach->name}}
                                        </td>
                                    </tr>
                                    @else
                                    <tr>
                                        <td colspan="4" class="text-center">
                                            No data available
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- End of lineups --}}
            </div>
        </div>
    </div>
</div>
<script>
    document.title = 'Football-Today | ' + "{{$teams->home->name}} " + ' vs ' + " {{$teams->away->name}}";
    retrieveSelected();
    barCharts();
    pieCharts();

    $('.nav-link').on('click', function () {
        localStorage.setItem("tagSelectedFixture", this.id);
        return true;
    });

    function retrieveSelected() {
        var curTag = localStorage.getItem("tagSelectedFixture");

        if (!curTag) {
            curTag = "pills-match-preview-tab"
        }

        $('#' + curTag).addClass('active');

        var tabContentId = $('#' + curTag).attr('aria-controls')

        $('#' + tabContentId).addClass('active')
        $('#' + tabContentId).addClass('show')
    }

    function barCharts() {
        const labels = ['Goals'];

        var home_score_data = ["{{$team_statistics['home']->goals->for->total->total}}"];
        var home_conceded_data = ["{{$team_statistics['home']->goals->against->total->total}}"];
        var h_home_score_data = ["{{$team_statistics['home']->goals->for->total->home}}"];
        var h_home_conceded_data = ["{{$team_statistics['home']->goals->against->total->home}}"];
        var away_score_data = ["{{$team_statistics['away']->goals->for->total->total}}"];
        var away_conceded_data = ["{{$team_statistics['away']->goals->against->total->total}}"];
        var a_away_score_data = ["{{$team_statistics['away']->goals->for->total->away}}"];
        var a_away_conceded_data = ["{{$team_statistics['away']->goals->against->total->away}}"];

        const home_data = {
            labels: labels,
            datasets: [{
                    label: "Scored",
                    data: home_score_data,
                    borderColor: '#12e5fa',
                    backgroundColor: '#12e5fa',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                },
                {
                    label: 'Conceded',
                    data: home_conceded_data,
                    borderColor: '#dc3545',
                    backgroundColor: '#dc3545',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                }
            ]
        };

        const h_home_data = {
            labels: labels,
            datasets: [{
                    label: "Scored",
                    data: h_home_score_data,
                    borderColor: '#12e5fa',
                    backgroundColor: '#12e5fa',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                },
                {
                    label: 'Conceded',
                    data: h_home_conceded_data,
                    borderColor: '#dc3545',
                    backgroundColor: '#dc3545',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                }
            ]
        };

        const away_data = {
            labels: labels,
            datasets: [{
                    label: "Scored",
                    data: away_score_data,
                    borderColor: '#12e5fa',
                    backgroundColor: '#12e5fa',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                },
                {
                    label: 'Conceded',
                    data: away_conceded_data,
                    borderColor: '#dc3545',
                    backgroundColor: '#dc3545',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                }
            ]
        };

        const a_away_data = {
            labels: labels,
            datasets: [{
                    label: "Scored",
                    data: a_away_score_data,
                    borderColor: '#12e5fa',
                    backgroundColor: '#12e5fa',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                },
                {
                    label: 'Conceded',
                    data: a_away_conceded_data,
                    borderColor: '#dc3545',
                    backgroundColor: '#dc3545',
                    barPercentage: 0.5,
                    categoryPercentage: 0.6,
                }
            ]
        };

        const home_config = {
            type: 'bar',
            data: home_data,
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                }
            }
        };

        const h_home_config = {
            type: 'bar',
            data: h_home_data,
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                }
            }
        };

        const away_config = {
            type: 'bar',
            data: away_data,
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                }
            }
        };

        const a_away_config = {
            type: 'bar',
            data: a_away_data,
            options: {
                indexAxis: 'y',
                elements: {
                    bar: {
                        borderWidth: 1,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: false
                    }
                }
            }
        };

        var homeChartDiagram = new Chart(
            document.getElementById('home_goals_bar'),
            home_config
        );

        var h_homeChartDiagram = new Chart(
            document.getElementById('h_home_goals_bar'),
            h_home_config
        );

        var awayChartDiagram = new Chart(
            document.getElementById('away_goals_bar'),
            away_config
        );

        var a_awayChartDiagram = new Chart(
            document.getElementById('a_away_goals_bar'),
            a_away_config
        );
    }

    function pieCharts() {
        const labels = ['Wins', 'Draws', 'Loses'];

        var home_res_data = [
            "{{$team_statistics['home']->fixtures->wins->home}}",
            "{{$team_statistics['home']->fixtures->draws->home}}",
            "{{$team_statistics['home']->fixtures->loses->home}}"
        ];
        var away_res_data = [
            "{{$team_statistics['away']->fixtures->wins->away}}",
            "{{$team_statistics['away']->fixtures->draws->away}}",
            "{{$team_statistics['away']->fixtures->loses->away}}"
        ];

        var h_home_res_data = [
            "{{$team_statistics['home']->fixtures->wins->total}}",
            "{{$team_statistics['home']->fixtures->draws->total}}",
            "{{$team_statistics['home']->fixtures->loses->total}}"
        ];
        var a_away_res_data = [
            "{{$team_statistics['away']->fixtures->wins->total}}",
            "{{$team_statistics['away']->fixtures->draws->total}}",
            "{{$team_statistics['away']->fixtures->loses->total}}"
        ];

        const home_data = {
            labels: labels,
            datasets: [{
                label: "Results",
                data: home_res_data,
                backgroundColor: ['#12e5fa', '#d4d9de', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const away_data = {
            labels: labels,
            datasets: [{
                label: "Results",
                data: away_res_data,
                backgroundColor: ['#12e5fa', '#d4d9de', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const h_home_data = {
            labels: labels,
            datasets: [{
                label: "Results",
                data: h_home_res_data,
                backgroundColor: ['#12e5fa', '#d4d9de', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const a_away_data = {
            labels: labels,
            datasets: [{
                label: "Results",
                data: a_away_res_data,
                backgroundColor: ['#12e5fa', '#d4d9de', '#dc3545'],
                hoverOffset: 4
            }]
        };

        const home_config = {
            type: 'doughnut',
            data: home_data,
            options: {
                aspectRatio: 2,
            }
        };

        const away_config = {
            type: 'doughnut',
            data: away_data,
            options: {
                aspectRatio: 2,
            }
        };

        const h_home_config = {
            type: 'doughnut',
            data: h_home_data,
            options: {
                aspectRatio: 2,
            }
        };

        const a_away_config = {
            type: 'doughnut',
            data: a_away_data,
            options: {
                aspectRatio: 2,
            }
        };

        var homeChartDiagram = new Chart(
            document.getElementById('home_res_pie'),
            home_config
        );

        var awayChartDiagram = new Chart(
            document.getElementById('away_res_pie'),
            away_config
        );

        var h_homeChartDiagram = new Chart(
            document.getElementById('h_home_res_pie'),
            h_home_config
        );

        var a_awayChartDiagram = new Chart(
            document.getElementById('a_away_res_pie'),
            a_away_config
        );
    }

</script>
