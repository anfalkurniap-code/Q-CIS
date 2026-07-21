<?php

namespace App\Http\Controllers;

use Iluminate\Http\Request;

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
