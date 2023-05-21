<div class="col-md-12 mb-2">
    <div class="card align-middle title-band text-white">
        <div class="row px-2 pt-4">
            <div class="col-md text-left">
                <h4>{{$league->country->name}} - {{$league->league->name}}</h4>
            </div>
            <div class="col-md-2 text-right select-col">
                <div class="form-group">
                    <select class="form-control-sm" name="season" id="season" onchange="setSeason(this.value)">
                        @foreach ($seasons as $single_season)
                        <option {{$single_season == $season ? 'selected' : ''}}>{{$single_season}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-12 mb-2">
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link" id="pills-table-tab" data-toggle="pill" href="#pills-table" role="tab"
                aria-controls="pills-table" aria-selected="true">Table</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-fixtures-tab" data-toggle="pill" href="#pills-fixtures" role="tab"
                aria-controls="pills-fixtures" aria-selected="false">Fixtures</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-tsa-tab" data-toggle="pill" href="#pills-tsa" role="tab"
                aria-controls="pills-tsa" aria-selected="false">Top Scorers/Assists</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pills-cards-tab" data-toggle="pill" href="#pills-cards" role="tab"
                aria-controls="pills-cards" aria-selected="false">Cards</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade" id="pills-table" role="tabpanel" aria-labelledby="pills-table-tab">
            {{-- Table --}}
            <div class="col-md-12 mb-2 px-0">
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
                                    <tr>
                                        <td>
                                            {{$standing->rank}}
                                        </td>
                                        <td class="text-left" style="white-space: nowrap;">
                                            <a class="no-underline" href="{{route('public.team.get', [
                                            'nation' => str_replace(' ', '_', $league->country->name),
                                            'id' => $standing->team->id,
                                            'club' => str_replace(' ', '_', $standing->team->name)]
                                            )}}">
                                                <img class="team-logo" src="{{$standing->team->logo}}" alt="">
                                                <span class="team-title">{{$standing->team->name}}</span>
                                            </a>
                                        </td>
                                        <td class="text-danger" style="font-weight: bold">
                                            {{$standing->all->played}}
                                        </td>
                                        <td class="text-newinfo" style="font-weight: bold">
                                            {{$standing->all->win}}
                                        </td>
                                        <td class="text-danger" style="font-weight: bold">
                                            {{$standing->all->draw}}
                                        </td>
                                        <td class="text-newinfo" style="font-weight: bold">
                                            {{$standing->all->lose}}
                                        </td>
                                        <td class="text-danger" style="font-weight: bold">
                                            {{$standing->all->goals->for}}
                                        </td>
                                        <td class="text-newinfo" style="font-weight: bold">
                                            {{$standing->all->goals->against}}
                                        </td>
                                        <td class="text-danger" style="font-weight: bold">
                                            {{$standing->goalsDiff}}
                                        </td>
                                        <td class="text-newinfo" style="font-weight: bold">
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
            {{-- End of Table --}}
        </div>
        <div class="tab-pane fade" id="pills-fixtures" role="tabpanel" aria-labelledby="pills-fixtures-tab">
            {{-- Fixtures --}}
            <div class="col-md-12 mb-2 px-0">
                <div class="card align-middle bg-dark text-white">
                    <h5 class="text-left p-2">Fixtures</h5>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="name" class="col-md-auto col-form-label">Round&nbsp;</label>
                            <div class="col-md-auto">
                                <select class="form-control" name="round" id="round" onchange="setRound(this.value)">
                                    @foreach ($rounds as $single_round)
                                    <option {{$single_round == $round ? 'selected' : ''}}>{{$single_round}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="fixture_list">
                            @forelse ($dates as $key => $date)
                            <div class="card">
                                <div class="card-header p-0" id="heading{{$key}}">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-center" data-toggle="collapse"
                                            data-target="#collapse{{$key}}" aria-expanded="true"
                                            aria-controls="collapse{{$key}}" style="width: 100%">
                                            {{\carbon\carbon::parse($fixtures[$date][0]->fixture->timestamp)->setTimezone($timezone)->format('l d/m/Y')}}
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse{{$key}}" class="collapse show" aria-labelledby="heading{{$key}}">
                                    <div class="card-body p-0 table-responsive">
                                        <table class="matches_new">
                                            <tbody>
                                                @foreach ($fixtures[$date] as $fixture)
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
                                                        <div class="match-card match-current-minute">
                                                            {{$fixture->fixture->status->elapsed}}'
                                                        </div>
                                                    </td>
                                                    @break
                                                    @case("2H")
                                                    <td class="minute visible">
                                                        <div class="match-card match-current-minute">
                                                            {{$fixture->fixture->status->elapsed}}'
                                                        </div>
                                                    </td>
                                                    @break
                                                    @case("ET")
                                                    <td class="minute visible">
                                                        <div class="match-card match-current-minute">
                                                            {{$fixture->fixture->status->elapsed}}'
                                                        </div>
                                                    </td>
                                                    @break
                                                    @case("HT")
                                                    <td class="minute visible">
                                                        <div class="match-card match-current-minute">
                                                            {{$fixture->fixture->status->short}}
                                                        </div>
                                                    </td>
                                                    @break
                                                    @default
                                                    <td class="minute visible-2">
                                                        <div class="match-card match-current-minute">
                                                            {{$fixture->fixture->status->short}}
                                                        </div>
                                                    </td>
                                                    @endswitch

                                                    <td class="team team-a">
                                                        <a href="{{route('public.team.get', [
                                                        'nation' => str_replace(' ', '_', $league->country->name),
                                                        'id' => $fixture->teams->home->id,
                                                        'club' => str_replace(' ', '_', $fixture->teams->home->name)]
                                                        )}}" class="flag_16 right_16 belize_16_right" title="Belize">
                                                            <span
                                                                class="team-title">{{$fixture->teams->home->name}}</span>
                                                            <img class="team-logo" src="{{$fixture->teams->home->logo}}"
                                                                alt="">
                                                        </a>
                                                    </td>

                                                    <td class="score-time status">
                                                        <a
                                                            href="{{route('public.fixture.get', $fixture->fixture->id)}}">
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
                                                    <td class="team team-b text-left">
                                                        <a href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country->name),
                                'id' => $fixture->teams->away->id,
                                'club' => str_replace(' ', '_', $fixture->teams->away->name)]
                                )}}" class="flag_16 left_16 st-lucia_16_left" title="St. Lucia">
                                                            <img class="team-logo" src="{{$fixture->teams->away->logo}}"
                                                                alt="">
                                                            <span
                                                                class="team-title">{{$fixture->teams->away->name}}</span>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            {{-- End of Fixtures --}}
        </div>
        <div class="tab-pane fade" id="pills-tsa" role="tabpanel" aria-labelledby="pills-tsa-tab">
            <div class="col-md-12 mb-2 px-0">
                <div class="row">
                    {{-- Top Scorers --}}
                    <div class="col-md-6">
                        <div class="card align-middle bg-dark text-white">
                            <h5 class="text-left p-2">Top Scorers</h5>
                        </div>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-left" scope="col">Player</th>
                                            <th class="text-center" scope="col">G</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($top_scorers as $key => $top_scorer)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td class="text-left" style="white-space: nowrap;">
                                                <a class="no-underline" href="{{route('public.team.get', [
                                    'nation' => str_replace(' ', '_', $league->country->name),
                                    'id' => $top_scorer->statistics[0]->team->id,
                                    'club' => str_replace(' ', '_', $top_scorer->statistics[0]->team->name)]
                                    )}}">
                                                    <img class="team-logo"
                                                        src="{{$top_scorer->statistics[0]->team->logo}}" alt="">
                                                </a>
                                                <a class="no-underline" href="">
                                                    <span class="team-title">{{$top_scorer->player->name}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{$top_scorer->statistics[0]->goals->total}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No Data Available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End of Top scorers --}}

                    {{-- Top Assists --}}
                    <div class="col-md-6">
                        <div class="card align-middle bg-dark text-white">
                            <h5 class="text-left p-2">Top Assists</h5>
                        </div>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-left" scope="col">Player</th>
                                            <th class="text-center" scope="col">A</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($top_assists as $key => $top_assist)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td class="text-left" style="white-space: nowrap;">
                                                <a class="no-underline" href="{{route('public.team.get', [
                                    'nation' => str_replace(' ', '_', $league->country->name),
                                    'id' => $top_assist->statistics[0]->team->id,
                                    'club' => str_replace(' ', '_', $top_assist->statistics[0]->team->name)]
                                    )}}">
                                                    <img class="team-logo"
                                                        src="{{$top_assist->statistics[0]->team->logo}}" alt="">
                                                </a>
                                                <a class="no-underline" href="">
                                                    <span class="team-title">{{$top_assist->player->name}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{$top_assist->statistics[0]->goals->assists}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No Data Available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End of Top Assists --}}
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-cards" role="tabpanel" aria-labelledby="pills-cards-tab">
            <div class="col-md-12 mb-2 px-0">
                <div class="row">
                    {{-- Most Yellow Cards --}}
                    <div class="col-md-6 mb-2 px-0">
                        <div class="card align-middle bg-dark text-white">
                            <h5 class="text-left p-2">Most Yellow Cards</h5>
                        </div>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-left" scope="col">Player</th>
                                            <th class="text-center" scope="col">Y</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($top_yellow_cards as $key => $top_yellow_card)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td class="text-left" style="white-space: nowrap;">
                                                <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country->name),
                                'id' => $top_yellow_card->statistics[0]->team->id,
                                'club' => str_replace(' ', '_', $top_yellow_card->statistics[0]->team->name)]
                                )}}">
                                                    <img class="team-logo"
                                                        src="{{$top_yellow_card->statistics[0]->team->logo}}" alt="">
                                                </a>
                                                <a class="no-underline" href="">
                                                    <span class="team-title">{{$top_yellow_card->player->name}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{$top_yellow_card->statistics[0]->cards->yellow}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No Data Available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End of Most Yellow Cards --}}

                    {{-- Most Red Cards --}}
                    <div class="col-md-6 mb-2 px-0">
                        <div class="card align-middle bg-dark text-white">
                            <h5 class="text-left p-2">Most Red Cards</h5>
                        </div>
                        <div class="card">
                            <div class="card-body table-responsive">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th class="text-left" scope="col">Player</th>
                                            <th class="text-center" scope="col">R</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($top_red_cards as $key => $top_red_card)
                                        <tr>
                                            <td>
                                                {{$key + 1}}
                                            </td>
                                            <td class="text-left" style="white-space: nowrap;">
                                                <a class="no-underline" href="{{route('public.team.get', [
                                'nation' => str_replace(' ', '_', $league->country->name),
                                'id' => $top_red_card->statistics[0]->team->id,
                                'club' => str_replace(' ', '_', $top_red_card->statistics[0]->team->name)]
                                )}}">
                                                    <img class="team-logo"
                                                        src="{{$top_red_card->statistics[0]->team->logo}}" alt="">
                                                </a>
                                                <a class="no-underline" href="">
                                                    <span class="team-title">{{$top_red_card->player->name}}</span>
                                                </a>
                                            </td>
                                            <td>
                                                {{$top_red_card->statistics[0]->cards->red}}
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                No Data Available
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- End of Most Red Cards --}}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.title = 'Football-Today | ' + "{{$league->country->name}}" + ' - ' + "{{$league->league->name}}";
    retrieveSelected();

    $('.nav-link').on('click', function () {
        localStorage.setItem("tagSelectedLeague", this.id);
        return true;
    });

    function retrieveSelected() {
        var curTag = localStorage.getItem("tagSelectedLeague");

        if (!curTag) {
            curTag = "pills-table-tab"
        }

        $('#' + curTag).addClass('active');

        var tabContentId = $('#' + curTag).attr('aria-controls')

        $('#' + tabContentId).addClass('active')
        $('#' + tabContentId).addClass('show')
    }

</script>
