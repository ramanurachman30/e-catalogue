<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MVissionMission extends Model
{
    //
    protected $table = 'm_vission_mission';

    protected $fillable = [
        'name',
        'type',
        'order',
    ];
}
