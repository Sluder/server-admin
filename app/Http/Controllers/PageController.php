<?php

namespace App\Http\Controllers;

use App\Website;

class PageController extends Controller
{
    // Displays stats about the hosting server
    public function server()
    {
        $info = \Larinfo::getServerInfo();
        $info['hardware']['disk_total'] = floor(disk_total_space("/") / (pow(1000, 3)));
        $info['hardware']['disk_free'] = floor(disk_free_space("/") / (pow(1000, 3)));

        return view('pages.server', compact('info'));
    }

    // Displays specific website stats
    public function website(Website $website)
    {
        return view('pages.website', compact('website'));
    }

}
