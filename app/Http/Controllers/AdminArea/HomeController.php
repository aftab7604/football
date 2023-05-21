<?php

namespace App\Http\Controllers\AdminArea;


class HomeController extends ParentController
{
    public function index()
    {
        return view('AdminArea.pages.dashboard.index');
    }
}
