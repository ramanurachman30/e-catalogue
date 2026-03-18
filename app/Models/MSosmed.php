<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MSosmed extends Model
{
    //
    protected $table = 'm_sosmed';

    protected $fillable = [
        'name',
        'description',
        'icon',
        'url',
    ];
}
