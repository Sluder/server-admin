<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    // Displays stats about the hosting server
    public function server()
    {
        return view('pages.server');
    }

}
