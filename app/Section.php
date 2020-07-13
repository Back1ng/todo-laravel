<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    public function todo()
    {
        return $this->hasMany(Todo::class);
    }
}
