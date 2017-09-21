<?php

namespace App\Http\Controllers;

class ServerController extends Controller
{
    // Ajax : Returns server usage stats
    public function getUsage()
    {
        $memory = explode(" ", preg_replace('!\s+!', " ", exec("free -m | grep Mem")));

        $stats['cpuUsage'] = (sys_getloadavg()[0] * 100) / (int)shell_exec("cat /proc/cpuinfo | grep processor | wc -l");
        $stats['ramUsage'] = ($memory[2] / $memory[1]) * 100;

        return $stats;
    }

    // Reboots hosting server
    public function reboot()
    {
        exec('sudo -u root -S /sbin/reboot ' . env('SERVER_PASSWORD'));
    }

}
