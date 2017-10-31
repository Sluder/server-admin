<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Pusher\Pusher;

class ServerController extends Controller
{
    // Ajax : Returns server usage stats
    public function getUsage()
    {
        $memory = explode(" ", preg_replace('!\s+!', " ", exec("free -m | grep Mem")));

        $stats['cpuUsage'] = min((sys_getloadavg()[0] * 100) / (int)shell_exec("cat /proc/cpuinfo | grep processor | wc -l"), 100);
        $stats['ramUsage'] = min(($memory[2] / $memory[1]) * 100, 100);

        return $stats;
    }

    // Deploys website
    public function deploy()
    {
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' =>  env('PUSHER_CLUSTER'),
                'encrypted' => true
            ]
        );

        $pusher->trigger('deploy-output', 'deploy-event', 'ds');
    }

    // Reboots hosting server
    public function reboot()
    {
        if (Hash::check(request('password'), env('SERVER_PASSWORD'))) {
            exec('sudo -u root -S /sbin/reboot ' . request('password'));
        }

        // TODO: Return back with error
        return redirect()->back()->withErrors(['error', 'You have entered the wrong admin password.']);
    }

}
