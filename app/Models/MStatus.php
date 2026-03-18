<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MStatus extends Model
{
    //
    protected $table = 'm_status';

    protected $fillable = ['name', 'description'];

    public function catalogue()
    {
        return $this->hasMany(MCatalogue::class);
    }
}
