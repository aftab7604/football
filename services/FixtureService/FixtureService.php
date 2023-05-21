<?php

namespace services\FixtureService;

use Carbon\Carbon;
use services\Callers\CurlCaller;
use services\Callers\LeagueCaller;

class FixtureService
{
    protected $important_league_list;

    const URL = 'https://v3.football.api-sports.io';

    public function __construct()
    {
        $this->important_league_list = config('app.important_league_list');
    }

    public function getAllFixtures()
    {
        if (isset($_COOKIE["date"])) {
            $date = $_COOKIE["date"];
        } else {
            $date = Carbon::now()->format('Y-m-d');
        }

        $url = self::URL . '/fixtures?date=' . $date;

        $resp = CurlCaller::get($url, []);

        $leagues_1 = [];
        $leagues_1_as = [];
        $leagues_2 = [];
        $leagues_2_as = [];
        $leagues_as = [];
        $response = [];

        if ($resp) {
            foreach ($resp->response as $key => $value) {
                if (in_array($value->league->id, $this->important_league_list)) {
                    if (!in_array($value->league->id, $leagues_1)) {
                        $leagues_1[$key] = $value->league->id;
                        $leagues_1_as[$value->league->id] = $value->league->name;
                    }
                } else {
                    if (!in_array($value->league->id, $leagues_2)) {
                        $leagues_2[$key] = $value->league->id;
                        $leagues_2_as[$value->league->id] = $value->league->country;
                    }
                }


                if (array_key_exists($value->league->id, $response)) {
                    array_push($response[$value->league->id], $value);
                } else {
                    $response[$value->league->id] = [$value];
                }
            }

            ksort($leagues_1_as);
            asort($leagues_2_as);
            $leagues_as = $leagues_1_as + $leagues_2_as;
        }
        // else {
        //     return $this->getAllFixtures();
        // }

        return ['leagues' => $leagues_as, 'fixtures' => $response];
    }

    public function getFixture(int $id)
    {
        $url = self::URL . '/fixtures?id=' . $id;

        $resp = CurlCaller::get($url, []);

        $response = [];
        $fixture = null;
        $league = null;
        $teams = null;
        $goals = null;
        $score = null;
        $events = null;
        $lineups = null;
        $match_statistics = null;
        $team_statistics = [];
        $h2h = [];
        $predictions = [];
        $standings = [];

        if ($resp) {
            if ($resp->results == 0) {
                return ['status' => false];
            }

            $response = $resp->response[0];
            $fixture = $resp->response[0]->fixture;
            $league = $resp->response[0]->league;
            $teams = $resp->response[0]->teams;
            $goals = $resp->response[0]->goals;
            $score = $resp->response[0]->score;
            $events = $resp->response[0]->events;
            $lineups = $resp->response[0]->lineups;
            $match_statistics = $resp->response[0]->statistics;

            $team_statistics = $this->getTeamStatistics($response);
            $h2h = $this->getH2H($response);
            $predictions = $this->getPredictions($id);
            $standings = LeagueCaller::getStandings($league->id, $league->season);
            $form = $this->getTeamForm($response);
        }
        //  else {
        //     return $this->getFixture($id);
        // }

        return [
            'status' => true,
            'fixture' => $fixture,
            'league' => $league,
            'teams' => $teams,
            'goals' => $goals,
            'score' => $score,
            'events' => $events,
            'lineups' => $lineups,
            'match_statistics' => $match_statistics,
            'team_statistics' => $team_statistics,
            'h2h' => $h2h,
            'predictions' => $predictions,
            'standings' => $standings,
            'form' => $form
        ];
    }

    public function getTeamStatistics($response)
    {
        $team_statistics = [];

        $league = $response->league->id;
        $season = $response->league->season;

        $home_team = $response->teams->home->id;
        $away_team = $response->teams->away->id;

        $url_1 = self::URL . '/teams/statistics?league=' . $league . '&season=' . $season . '&team=' . $home_team;

        $resp_1 = CurlCaller::get($url_1, []);

        if ($resp_1) {
            $team_statistics['home'] = $resp_1->response;
        }
        // else {
        //     return $this->getTeamStatistics($response);
        // }

        $url_2 = self::URL . '/teams/statistics?league=' . $league . '&season=' . $season . '&team=' . $away_team;

        $resp_2 = CurlCaller::get($url_2, []);

        if ($resp_2) {
            $team_statistics['away'] = $resp_2->response;
        }
        // else {
        //     return $this->getTeamStatistics($response);
        // }

        return $team_statistics;
    }

    public function getTeamForm($response)
    {
        $team_form = [];

        $season = $response->league->season;

        $home_team = $response->teams->home->id;
        $away_team = $response->teams->away->id;

        $url_1 = self::URL . '/fixtures?last=5&season=' . $season . '&team=' . $home_team;

        $resp_1 = CurlCaller::get($url_1, []);

        if ($resp_1) {
            $team_form['home'] = $resp_1->response;
        }
        // else {
        //     return $this->getTeamStatistics($response);
        // }

        $url_2 = self::URL . '/fixtures?last=5&season=' . $season . '&team=' . $away_team;

        $resp_2 = CurlCaller::get($url_2, []);

        if ($resp_2) {
            $team_form['away'] = $resp_2->response;
        }
        // else {
        //     return $this->getTeamStatistics($response);
        // }

        return $team_form;
    }

    public function getH2H($response)
    {
        $h2h = [];

        $home_team = $response->teams->home->id;
        $away_team = $response->teams->away->id;

        $url = self::URL . '/fixtures/headtohead?h2h=' . $home_team . '-' . $away_team . '&last=' . 5;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $h2h = $resp->response;
        }
        // else {
        //     return $this->getH2H($response);
        // }

        return $h2h;
    }

    public function getPredictions($id)
    {
        $predictions = [];

        $url = self::URL . '/predictions?fixture=' . $id;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $predictions = $resp->response;
        }
        // else {
        //     return $this->getPredictions($id);
        // }
        $predictions_array = $this->getPredictionsArray($predictions);

        return ['predictions' => $predictions, 'predictions_array' => $predictions_array];
    }

    public function getPredictionsArray($predictions)
    {
        $predictions_array = [];

        foreach ($predictions as $prediction) {
            $i = 0;
            foreach ($prediction->comparison as  $comparison) {
                $predictions_array['home'][$i] = str_replace('%', '', $comparison->home);
                $predictions_array['away'][$i] = str_replace('%', '', $comparison->away);
                $i++;
            }
        }

        return $predictions_array;
    }
}
