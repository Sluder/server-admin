<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;

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

    public function deploy()
    {
        broadcast("test");
    }

    // Reboots hosting server
    public function reboot()
    {
        if (Hash::check(request('password'), env('SERVER_PASSWORD'))) {
            // TODO: Return back with error
            return redirect()->back();
        }

        exec('sudo -u root -S /sbin/reboot ' . request('password'));
    }

}
