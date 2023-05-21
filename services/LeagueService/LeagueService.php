<?php

namespace services\LeagueService;

use Carbon\Carbon;
use services\Callers\CurlCaller;

class LeagueService
{
    protected $important_league_list;

    const URL = 'https://v3.football.api-sports.io';

    public function __construct()
    {
        $this->important_league_list = config('app.important_league_list');
    }

    public function getAllLeagues()
    {
        $url = self::URL . '/leagues?current=true';

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
                        $leagues_2_as[$value->league->id] = $value->league->name;
                    }
                }
                $response[$value->league->id] = $value;
            }

            ksort($leagues_1_as);
            asort($leagues_2_as);
            $leagues_as = $leagues_1_as + $leagues_2_as;
        }
        //  else {
        //     return $this->getAllLeagues();
        // }

        return ['leagues_ordered' => $leagues_as, 'leagues' => $response];
    }

    public function getLeague(int $id)
    {
        if (isset($_COOKIE["season"])) {
            $season = $_COOKIE["season"];
        } else {
            $season = $this->getCurrentSeason($id);
        }

        if (isset($_COOKIE["round"])) {
            $round = $_COOKIE["round"];
        } else {
            $round = $this->getCurrentRound($id);
        }

        $seasons = [];
        $rounds = [];
        $league = [];
        $standings = [];
        $fixtures = [];
        $dates = [];
        $top_scorers = [];
        $top_assists = [];
        $top_yellow_cards = [];
        $top_red_cards = [];

        $url = self::URL . '/leagues?id=' . $id;

        $resp = CurlCaller::get($url, []);
        if ($resp) {
            if ($resp->results > 0) {
                $league = $resp->response[$resp->results - 1];

                $standings = $this->getStandings($id, $season);

                $fixtures_data = $this->getFixtures($id, $season, $round);
                $fixtures = $fixtures_data['fixtures'];
                $dates = $fixtures_data['dates'];

                $top_scorers = $this->getTopScorers($id, $season);
                $top_assists = $this->getTopAssists($id, $season);
                $top_yellow_cards = $this->getTopYellowCards($id, $season);
                $top_red_cards = $this->getTopRedCards($id, $season);
            }
        }
        // else {
        //     return $this->getLeague($id);
        // }

        $seasons = $this->getSeasons();
        $rounds = $this->getRounds($id, $season);

        return [
            'status' => true,
            'season' => $season,
            'round' => $round,
            'seasons' => $seasons,
            'rounds' => $rounds,
            'league' => $league,
            'standings' => $standings,
            'fixtures' => $fixtures,
            'dates' => $dates,
            'top_scorers' => $top_scorers,
            'top_assists' => $top_assists,
            'top_yellow_cards' => $top_yellow_cards,
            'top_red_cards' => $top_red_cards
        ];
    }

    public function getSeasons()
    {
        $seasons = [];

        $url = self::URL . '/leagues/seasons';

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $seasons = $resp->response;
        }
        // else {
        //     return $this->getSeasons();
        // }

        return $seasons;
    }

    public function getCurrentSeason($id)
    {
        $season = "";

        $url = self::URL . '/leagues?id=' . $id . '&current=true';

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            if ($resp->results > 0) {
                if (isset($resp->response[0]->seasons[0])) {
                    $season = $resp->response[0]->seasons[0]->year;
                }
            }
        }
        // else {
        //     return $this->getCurrentSeason($id);
        // }

        return $season;
    }
    public function getRounds($id, $season)
    {
        $rounds = [];

        $url = self::URL . '/fixtures/rounds?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $rounds = $resp->response;
        }
        // else {
        //     return $this->getRounds($id, $season);
        // }

        return $rounds;
    }

    public function getCurrentRound($id)
    {
        $round = '';

        $season = $this->getCurrentSeason($id);

        $url = self::URL . '/fixtures/rounds?league=' . $id . '&season=' . $season . '&current=true';

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            if ($resp->results > 0) {
                $round = $resp->response[0];
            }
        }
        // else {
        //     return $this->getCurrentRound($id);
        // }

        return $round;
    }

    public function getStandings($id, $season)
    {
        $standings = [];

        $url = self::URL . '/standings?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            if ($resp->results > 0) {
                $standings = $resp->response[0]->league->standings;
            }
        }
        // else {
        //     return $this->getStandings($id, $season);
        // }

        return $standings;
    }

    public function getTopScorers($id, $season)
    {
        $top_scorers = [];

        $url = self::URL . '/players/topscorers?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $top_scorers = $resp->response;
        }
        // else {
        //     return $this->getTopScorers($id, $season);
        // }

        return $top_scorers;
    }

    public function getTopAssists($id, $season)
    {
        $top_assists = [];

        $url = self::URL . '/players/topassists?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $top_assists = $resp->response;
        }
        // else {
        //     return $this->getTopAssists($id, $season);
        // }

        return $top_assists;
    }

    public function getTopYellowCards($id, $season)
    {
        $top_yellow_cards = [];

        $url = self::URL . '/players/topyellowcards?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $top_yellow_cards = $resp->response;
        }
        //  else {
        //     return $this->getTopYellowCards($id, $season);
        // }

        return $top_yellow_cards;
    }

    public function getTopRedCards($id, $season)
    {
        $top_red_cards = [];

        $url = self::URL . '/players/topredcards?league=' . $id . '&season=' . $season;

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $top_red_cards = $resp->response;
        }
        //  else {
        //     return $this->getTopRedCards($id, $season);
        // }

        return $top_red_cards;
    }

    public function getFixtures($id, $season, $round)
    {

        $url = self::URL . '/fixtures?league=' . $id . '&season=' . $season . '&round=' . $round;

        $resp = CurlCaller::get($url, []);

        $dates = [];
        $fixtures = [];

        if ($resp) {
            foreach ($resp->response as $key => $value) {
                $fixture_date = Carbon::parse($value->fixture->timestamp)->format('d/m/Y');
                if (!in_array($fixture_date, $dates)) {
                    $dates[$key] = $fixture_date;
                }


                if (array_key_exists($fixture_date, $fixtures)) {
                    array_push($fixtures[$fixture_date], $value);
                } else {
                    $fixtures[$fixture_date] = [$value];
                }
            }
        }
        // else {
        //     return $this->getFixtures($id, $season, $round);
        // }

        return ['dates' => $dates, 'fixtures' => $fixtures];
    }

    public function getLeagueFromLeagueName($nation, $league_name)
    {
        $league = null;

        $nation = str_replace('_', '', $nation);
        $league_name = str_replace('_', ' ', $league_name);

        $url = self::URL . '/leagues?country=' . urlencode($nation) . '&name=' . urlencode($league_name);

        $resp = CurlCaller::get($url, []);

        if ($resp) {
            $league = $resp->response[0]->league;
        }
        // else {
        //     return $this->getLeagueFromLeagueName($nation, $league_name);
        // }

        return $league;
    }
}
