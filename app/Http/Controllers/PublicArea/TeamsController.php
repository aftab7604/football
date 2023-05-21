<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use services\Callers\LeagueCaller;
use services\Callers\TeamCaller;

class TeamsController extends Controller
{
    public function getTeam($nation, $club, $id)
    {
        // $team = TeamCaller::getTeamByNLC($nation, $league, $club, Carbon::now()->year);
        $team = TeamCaller::getTeamById($id);
        setcookie('season_team', LeagueCaller::getCurrentSeason(TeamCaller::getLeagues($team->id)[0]->league->id), time() + (86400 * 30), "/team");
        setcookie('league', TeamCaller::getLeagues($team->id)[0]->league->id, time() + (86400 * 30), "/team");

        $response['id'] = $id;

        return view('PublicArea.pages.teams.single-team')->with($response);
    }

    public function getTeamAjax(int $id)
    {

        $data = TeamCaller::getTeam($id);

        if (!$data['status']) {
            return '<div class="col-md-12 mb-2">No results found</div>';
        }

        $response['season'] = $data['season'];
        $response['seasons'] = $data['seasons'];
        $response['leagues'] = $data['leagues'];
        $response['league'] = $data['league'];
        $response['team'] = $data['team'];
        $response['fixtures'] = $data['fixtures'];
        $response['standings'] = $data['standings'];
        $response['players'] = $data['players'];
        $response['playersByPosition'] = $data['playersByPosition'];
        $response['team_statistics'] = $data['team_statistics'];
        $response['timezone'] = get_local_time();

        return view('PublicArea.pages.teams.single-team-ajax')->with($response);
    }
}
