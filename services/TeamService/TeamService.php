<?php

namespace services\TeamService;

use Carbon\Carbon;
use services\Callers\CurlCaller;
use services\Callers\LeagueCaller;

class TeamService
{
    protected $important_league_list;

    const URL = 'https://v3.football.api-sports.io';

    public function __construct()
    {
        $this->important_league_list = config('app.important_league_list');
    }

    public function getTeam(int $id)
    {
        $seasons = [];
        $team = [];
        $leagues = [];
        $fixtures = [];
        $standings = [];
        $players = [];
        $team_statistics = [];


        $leagues = $this->getLeagues($id);

        if (isset($_COOKIE["league"])) {
            $league = $_COOKIE["league"];
        } else {
            $league = $leagues[0]->league->id;
        }

        if (isset($_COOKIE["season_team"])) {
            $season = $_COOKIE["season_team"];
        } else {
            $season = LeagueCaller::getCurrentSeason($league);
        }

        $url = self::URL . '/teams?id=' . $id;

        $resp = CurlCaller::get($url, []);
        if ($resp) {
            $team = $resp->response[0];
            $fixtures = $this->getFixtures($id, $league, $season);
            $standings = $this->getStandings($id, $league, $season);
            $players = $this->getPlayers($id, $league, $season, 1, []);
            $team_statistics = $this->getTeamStatistics($id, $league, $season);
            $playersByPosition = [
                
                'Goalkeeper'=>array(),
                'Defender'=>array(),
                'Midfielder'=>array(),
                'Attacker'=>array()
            ];
           
            foreach ($players as $k => $playerData) {
                $position = $playerData->statistics[0]->games->position;
                
                if (!isset($playersByPosition[$position])) {
                    $playersByPosition[$position][] = $playerData;
                }
                
                $playersByPosition[$position][] = $playerData;
            }
        }
        // else {
        //     return $this->getTeam($id);
        // }

        $seasons = LeagueCaller::getSeasons();

        return [
            'status' => true,
            'season' => $season,
            'seasons' => $seasons,
            'leagues' => $leagues,
            'league' => $league,
            'team' => $team,
            'fixtures' => $fixtures,
            'standings' => $standings,
            'players' => $players,
            'playersByPosition' => $playersByPosition,
            'team_statistics' => $team_statistics
        ];
    }

    public function getLeagues($id)
    {
        $leagues = [];

        $url = self::URL . '/leagues?team=' . $id;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $leagues = $resp->response;
        }
        // else {
        //     return $this->getLeagues($id);
        // }

        return $leagues;
    }
    public function getStandings($id, $league, $season)
    {
        $standings = [];

        $url = self::URL . '/standings?league=' . $league . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            if ($resp->results > 0) {
                $standings = $resp->response[0]->league->standings;
            }
        }
        // else {
        //     return $this->getStandings($id, $league, $season);
        // }

        return $standings;
    }

    public function getPlayers($id, $league, $season, $page, $players)
    {
        $url = self::URL . '/players?team=' . $id . '&season=' . $season . '&league=' . $league . '&page=' . $page;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            if ($resp->results > 0) {
                $players = array_merge($players, $resp->response);;
            }
            if ($resp->paging->current != $resp->paging->total) {
                $page++;
                return $this->getPlayers($id, $league, $season, $page, $players);
            }
        }
        // else {
        //     return $this->getPlayers($id, $league, $season, $page, $players);
        // }

        return $players;
    }

    public function getFixtures($id, $league, $season)
    {
        $fixtures = [];
        $reverseFixtures = [];
        $fixturesByMY = [];

        $url = self::URL . '/fixtures?team=' . $id . '&season=' . $season . '&league=' . $league;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $fixtures = $resp->response;
            if(count($fixtures) > 0){
                for($i = (count($fixtures)-1) ; $i >= 0 ; $i--){
                    $reverseFixtures[] = $fixtures[$i];
                }

                foreach ($reverseFixtures as $k=>$v) {
                    $YearMonth = date("Y-m",$v->fixture->timestamp);
                    $fixturesByMY[$YearMonth][] = $v;
                }

               
            }
        }
        // else {
        //     return $this->getFixtures($id, $league, $season);
        // }

        return $fixturesByMY;
    }

    public function getTeamStatistics($id, $league, $season)
    {
        $team_statistics = [];

        $url = self::URL . '/teams/statistics?league=' . $league . '&season=' . $season . '&team=' . $id;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $team_statistics = $resp->response;
        }
        // else {
        //     return $this->getTeamStatistics($id, $league, $season);
        // }

        return $team_statistics;
    }

    public function getTeamByNLC($nation, $league, $club, $season)
    {
        $team = null;

        $league_obj = LeagueCaller::getLeagueFromLeagueName($nation, $league);

        $nation = str_replace('_', '', $nation);
        $league = str_replace('_', ' ', $league);
        $club = str_replace('_', ' ', $club);

        $url = self::URL . '/teams?country=' . $nation . '&league=' . $league_obj->id . '&name=' . $club . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp && isset($resp->response[0])) {
            $team = $resp->response[0]->team;
        }
        // else {
        //     $season--;
        //     return $this->getTeamByNLC($nation, $league, $club, $season);
        // }

        return $team;
    }

    public function getTeamById($id)
    {
        $team = null;

        $url = self::URL . '/teams?id=' . $id;

        $resp = CurlCaller::get($url, []);

        if ($resp && isset($resp->response[0])) {
            $team = $resp->response[0]->team;
        }
        // else {
        //     return $this->getTeamById($id);
        // }

        return $team;
    }
}
