<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Postulation extends Model
{
    public function assistant()
    {
        return $this->belongsTo(Assistant::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subjects::class);
    }

    public function assistantScores()
    {
        return $this->hasMany(AssistantScore::class);
    }

}
