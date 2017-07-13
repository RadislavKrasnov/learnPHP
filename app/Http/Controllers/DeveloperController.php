<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Developer;
use App\Project;
use App\Technology;

class DeveloperController extends Controller
{
    public function index()
    {
        $developers =Developer::paginate(10);
        return view('developers', compact('developers'));
    }

    public function devInfo($id)
    {
        $devIndex = Developer::find($id);

        return view('devInfo', compact('devIndex'));
    }

    public function addTech(Request $request)
    {
        $devID = $request->input('devId');
        $techIds = $request->input('techIds');

        $developer = Developer::find($devID);
        $developer->technologies()->attach($techIds);;
        return redirect()->action('DeveloperController@devInfo', ['id' => $devID]);
    }

    public function removeTech(Request $request)
    {
        $devID = $request->input('devId');
        $techId = $request->input('techId');

        $developer = Developer::find($devID);
        $developer->technologies()->detach($techId);;
        return redirect()->action('DeveloperController@devInfo', ['id' => $devID]);
    }

    public function removeProject(Request $request)
    {
        $devID = $request->input('devId');
        $projId = $request->input('projId');

        $developer = Developer::find($devID);
        $developer->technologies()->detach($projId);;
        return redirect()->action('DeveloperController@devInfo', ['id' => $devID]);
    }
}
