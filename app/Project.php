<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function developers()
    {
        return $this->belongsToMany('App\Developer');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Technology', 'project_technology', 'project_id', 'technology_id');
    }
}
