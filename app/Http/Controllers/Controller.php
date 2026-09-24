<?php

namespace App\Http\Controllers;

class DashboardControler extends Controller
{
    public function index()
    {
        return view('Landing');
    }
}

abstract class Controller
{
    //
}
