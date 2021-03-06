<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    protected $table = 'websites';
    public $timestamps = true;

    public function commands()
    {
        return $this->hasMany('App\DeployCommand');
    }

}
