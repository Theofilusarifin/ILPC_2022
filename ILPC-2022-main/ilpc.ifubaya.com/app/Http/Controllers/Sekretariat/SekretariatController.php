<?php

namespace App\Http\Controllers\Sekretariat;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Regency;
use App\Models\School;
use App\Models\Team;
use Illuminate\Http\Request;

class SekretariatController extends Controller
{
    public function index()
    {
        return view('sekretariat.index');
    }

    public function getRegistrationCount()
    {
        $waiting_teams = count(Team::where('status', "waiting")->get());
        $unverified_teams = count(Team::where('status', "unverified")->get());
        $completed_teams = count(Team::where('status', "ready")->get());

        return response()->json(array(
            'waiting_teams' => $waiting_teams,
            'unverified_teams' => $unverified_teams,
            'completed_teams' => $completed_teams
        ), 200);
    }
}
