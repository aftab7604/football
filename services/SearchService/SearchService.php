<?php

namespace services\SearchService;

use Carbon\Carbon;
use services\Callers\CurlCaller;

class SearchService
{
    protected $important_league_list;

    const URL = 'https://v3.football.api-sports.io';

    public function __construct()
    {
        $this->important_league_list = config('app.important_league_list');
    }

    public function getAllSearchResults($data)
    {
        $leagues = [];
        $teams = [];
        $venues = [];

        $leagues = $this->getLeagues($data);
        $teams = $this->getTeams($data);
        $venues = $this->getVenues($data);

        return ['leagues' => $leagues, 'teams' => $teams, 'venues' => $venues, 'search' => $data['search']];
    }

    public function getLeagues($data)
    {
        $url = self::URL . '/leagues?search=' . $data['search'];

        $resp = CurlCaller::get($url, []);

        $leagues = [];

        if ($resp) {
            $leagues = $resp->response;
        }
        // else {
        //     return $this->getLeagues($data);
        // }

        return array_slice($leagues, 0, 50);
    }

    public function getTeams($data)
    {
        $url = self::URL . '/teams?search=' . $data['search'];

        $resp = CurlCaller::get($url, []);

        $teams = [];

        if ($resp) {
            $teams = $resp->response;
        }
        // else {
        //     return $this->getTeams($data);
        // }

        return array_slice($teams, 0, 50);
    }

    public function getVenues($data)
    {
        $url = self::URL . '/venues?search=' . $data['search'];

        $resp = CurlCaller::get($url, []);

        $venues = [];

        if ($resp) {
            $venues = $resp->response;
        }
        // else {
        //     return $this->getVenues($data);
        // }

        return array_slice($venues, 0, 50);
    }
}
