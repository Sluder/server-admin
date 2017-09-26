<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeployCommand extends Model
{
    protected $table = 'deploy_commands';
    public $timestamps = false;
}
