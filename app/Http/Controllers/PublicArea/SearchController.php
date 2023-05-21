<?php

namespace App\Http\Controllers\PublicArea;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use services\Callers\SearchCaller;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $data = SearchCaller::getAllSearchResults($request->all());

        $response['leagues'] = $data['leagues'];
        $response['teams'] = $data['teams'];
        $response['venues'] = $data['venues'];
        $response['search'] = $data['search'];

        return view('PublicArea.pages.search.search')->with($response);
    }
}
