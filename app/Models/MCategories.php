<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MCategories extends Model
{
    //
    protected $table = 'm_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function catalogue()
    {
        return $this->hasMany(MCatalogue::class);
    }
}
