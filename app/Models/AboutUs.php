<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    //
    protected $table = 'about_us';

    protected $fillable = [
        'title',
        'sub_title',
        'description',
        'content_left',
        'content_right',
        'image',
    ];
}
