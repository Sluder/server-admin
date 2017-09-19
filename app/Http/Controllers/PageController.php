<?php

namespace App\Http\Controllers;

use App\Website;

class PageController extends Controller
{
    // Displays stats about the hosting server
    public function server()
    {
        return view('pages.server');
    }

    // Displays specific website stats
    public function website(Website $website)
    {
        return view('pages.website', compact('website'));
    }

}
