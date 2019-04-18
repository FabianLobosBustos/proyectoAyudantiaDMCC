<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    public function careers()
    {
        return $this->belongsToMany(Career::class);
    }
}
