<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Project;
use App\Technology;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Developer extends Model
{
//    public function index()
//    {
//
//    }
    public function projects()
    {
        return $this->belongsToMany('App\Project', 'developer_project', 'developer_id', 'project_id');
    }

    public function technologies()
    {
        return $this->belongsToMany('App\Technology', 'developer_technology', 'developer_id', 'technology_id');
    }
//Retrieve not added technologies and output it in developers list
   /* public function scopeDat($query)
    {
        $chosenArray = DB::table('developer_technology')->select('technology_id')
            ->where('developer_id', '=', $this->getAttribute('id'))->get();

        $techIds = [];
        foreach ($chosenArray as $chosen) {
            $techIds[] = $chosen->technology_id;
        }

        $techs = Technology::select('id', 'name')->whereNotIn('id', $techIds)->get();

        $techArray = [];

        foreach ($techs as $tech) {
            $techArray[$tech->id] = $tech->name;
        }

        return $techArray;

//       return DB::table('technologies')->select('name')->where('id', '=', '7');


    }*/
//retrieve technologies that have developer for technologies list in developer page
   public function scopeTechList($query)
   {
       $techArray = DB::table('developer_technology')->select('technology_id')
           ->where('developer_id', '=', $this->getAttribute('id'))->get();

       $techIds = [];

       foreach ($techArray as $tech) {
           $techIds[] = $tech->technology_id;
       }

       return $techs = Technology::select('id', 'name')->whereIn('id', $techIds)->get();

//       $techList = [];
//       foreach ($techs as $item) {
//           $techList[$item->id] = $item->name;
//       }

//       return $techList;
   }
//retrieve all technologies that haven't developer
    public function scopeNotChoseTechs($query)
    {
        $techArray = DB::table('developer_technology')->select('technology_id')
            ->where('developer_id', '=', $this->getAttribute('id'))->get();

        $techIds = [];

        foreach ($techArray as $tech) {
            $techIds[] = $tech->technology_id;
        }

        $techs = Technology::select('id', 'name')->whereNotIn('id', $techIds)->get();

        $notAdded = [];

        foreach ($techs as $i) {
            $notAdded[$i->id] = $i->name;
        }

        return $notAdded;
    }

}
