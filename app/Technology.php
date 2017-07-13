<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function developers()
    {
        return $this->belongsToMany('App\Developer');
    }
}
