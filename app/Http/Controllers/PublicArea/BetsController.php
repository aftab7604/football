<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Callers\SearchCaller;

class BetsController extends Controller
{
    public function bets()
    {
        return view('PublicArea.pages.bets.all');
    }
}
