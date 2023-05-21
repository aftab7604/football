<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use services\Callers\LeagueCaller;

class LeaguesController extends Controller
{
    public function leagues()
    {
        return view('PublicArea.pages.leagues.all-leagues');
    }

    public function leaguesAjax()
    {
        $response['leagues'] = [];

        $data = LeagueCaller::getAllLeagues();

        $response['leagues_ordered'] = $data['leagues_ordered'];
        $response['leagues'] = $data['leagues'];
        $response['timezone'] = get_local_time();

        return view('PublicArea.pages.leagues.all-leagues-ajax')->with($response);
    }

    public function getLeague(string $nation, string $league_name)
    {
        $league = LeagueCaller::getLeagueFromLeagueName($nation, $league_name);

        setcookie('season', LeagueCaller::getCurrentSeason($league->id), time() + (86400 * 30), "/leagues");
        setcookie('round', LeagueCaller::getCurrentRound($league->id), time() + (86400 * 30), "/leagues");

        $response['id'] = $league->id;

        return view('PublicArea.pages.leagues.single-league')->with($response);
    }

    public function getLeagueAjax(int $id)
    {
        $data = LeagueCaller::getLeague($id);

        if (!$data['status']) {
            return '<div class="col-md-12 mb-2">No results found</div>';
        }

        $response['season'] = $data['season'];
        $response['round'] = $data['round'];
        $response['seasons'] = $data['seasons'];
        $response['rounds'] = $data['rounds'];
        $response['league'] = $data['league'];
        $response['standings'] = $data['standings'];
        $response['fixtures'] = $data['fixtures'];
        $response['dates'] = $data['dates'];
        $response['top_scorers'] = $data['top_scorers'];
        $response['top_assists'] = $data['top_assists'];
        $response['top_yellow_cards'] = $data['top_yellow_cards'];
        $response['top_red_cards'] = $data['top_red_cards'];
        $response['timezone'] = get_local_time();

        return view('PublicArea.pages.leagues.single-league-ajax')->with($response);
    }
}
