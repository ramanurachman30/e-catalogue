<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCatalogue extends Model
{
    //
    protected $table = 'm_catalogue';

    protected $fillable = [
        'name',
        'description',
        'img',
        'category_id',
        'status_id',
        'date_release',
        'size_painting',
        'author',
        'price',
    ];

    public function category()
    {
        return $this->belongsTo(MCategories::class);
    }

    public function status()
    {
        return $this->belongsTo(MStatus::class);
    }
}
