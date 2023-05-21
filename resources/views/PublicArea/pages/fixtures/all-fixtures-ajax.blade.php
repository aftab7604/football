@foreach ($leagues as $key => $league)
<div class="card">
    <div class="card-header p-0" id="heading{{$key}}">
        <h5 class="mb-0">
            <button class="btn btn-link text-left" data-toggle="collapse" data-target="#collapse{{$key}}"
                aria-expanded="true" aria-controls="collapse{{$key}}">
                <img width="8%" src="{{$fixtures[$key][0]->league->logo}}" alt="">
                {{$fixtures[$key][0]->league->country}} - {{$fixtures[$key][0]->league->name}}
            </button>
        </h5>
    </div>

    <div id="collapse{{$key}}" class="collapse {{in_array($key, config('app.important_league_list')) ? 'show' : ''}}"
        aria-labelledby="heading{{$key}}">
        <div class="card-body p-0 table-responsive">
            <table class="matches_new">
                <tbody>
                    @foreach ($fixtures[$key] as $fixture)
                    <tr class="match  border no-date-repetition">
                        @switch($fixture->fixture->status->short)
                        @case("CANC")
                        <td class="minute novis">
                            <div class="match-card match-current-minute">&nbsp;</div>
                        </td>
                        @break
                        @case("NS")
                        <td class="minute novis">
                            <div class="match-card match-current-minute">&nbsp;</div>
                        </td>
                        @break
                        @case("PST")
                        <td class="minute novis">
                            <div class="match-card match-current-minute">&nbsp;</div>
                        </td>
                        @break
                        @case("TBD")
                        <td class="minute novis">
                            <div class="match-card match-current-minute">&nbsp;</div>
                        </td>
                        @break
                        @case("1H")
                        <td class="minute visible">
                            <div class="match-card match-current-minute">{{$fixture->fixture->status->elapsed}}'</div>
                        </td>
                        @break
                        @case("2H")
                        <td class="minute visible">
                            <div class="match-card match-current-minute">{{$fixture->fixture->status->elapsed}}'</div>
                        </td>
                        @break
                        @case("ET")
                        <td class="minute visible">
                            <div class="match-card match-current-minute">{{$fixture->fixture->status->elapsed}}'</div>
                        </td>
                        @break
                        @case("HT")
                        <td class="minute visible">
                            <div class="match-card match-current-minute">{{$fixture->fixture->status->short}}</div>
                        </td>
                        @break
                        @default
                        <td class="minute visible-2">
                            <div class="match-card match-current-minute">{{$fixture->fixture->status->short}}</div>
                        </td>
                        @endswitch

                        <td class="team team-a">
                            <a href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $fixture->league->country),
                                'id' => $fixture->teams->home->id,
                                'club' => str_replace(' ', '_', $fixture->teams->home->name)]
                                )}}" class="flag_16 right_16 belize_16_right" title="Belize">
                                {{$fixture->teams->home->name}}
                                <img width="8%" src="{{$fixture->teams->home->logo}}" alt="">
                            </a>
                        </td>

                        <td class="score-time status">
                            <a href="{{route('public.fixture.get', $fixture->fixture->id)}}">
                                @switch($fixture->fixture->status->short)
                                @case("CANC")
                                {{$fixture->fixture->status->short}}
                                @break
                                @case("PST")
                                {{$fixture->fixture->status->short}}
                                @break
                                @case("TBD")
                                {{$fixture->fixture->status->short}}
                                @break
                                @case("NS")
                                {{\carbon\carbon::parse($fixture->fixture->timestamp)->setTimezone($timezone)->format('H:i')}}
                                @break
                                @default
                                {{$fixture->goals->home}} - {{$fixture->goals->away}}
                                @endswitch
                            </a>
                        </td>
                        <td class="team team-b">
                            <a href="{{route('public.team.get',  [
                                'nation' => str_replace(' ', '_', $fixture->league->country),
                                'id' => $fixture->teams->away->id,
                                'club' => str_replace(' ', '_', $fixture->teams->away->name)]
                                )}}" class="flag_16 left_16 st-lucia_16_left" title="St. Lucia">
                                <img width="8%" src="{{$fixture->teams->away->logo}}" alt="">
                                {{$fixture->teams->away->name}}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                    <tr class="match  border no-date-repetition">
                        <td class="minute novis">
                            <div class="match-card match-current-minute">&nbsp;</div>
                        </td>
                        <td class="text-center" colspan="3">
                            <a class="btn btn-xs btn-secondary" href="{{route('public.league.get', ['nation' => str_replace(' ','_', $fixtures[$key][0]->league->country),
                                'league_name' => str_replace(' ','_', $fixtures[$key][0]->league->name)])}}">
                                View League
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endforeach
