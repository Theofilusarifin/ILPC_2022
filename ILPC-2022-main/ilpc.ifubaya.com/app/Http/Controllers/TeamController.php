<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Province;
use App\Models\School;
use App\Models\Team;

class TeamController extends Controller
{




    public function index()
    {
        $list_Teams = Team::all();
    }




    public function create()
    {
        // Directly fill school (instead of province and regency first)
        $list_Schools = School::all();

        return view('teams.create', compact('list_Teams'));
    }


    public function create2(School $school) // Create page 2
    {
        $list_Teachers = $school->teachers;

        return view('teams.create2', compact('list_Teams'));
    }


    public function create3() // Create page 3
    {
        // To check if team name is unique
        $list_Teams = Team::all();

        return view('teams.create3', compact('list_Teams'));
    }




    public function store(TeamRequest $request)
    {
        $attr = $request->all();
        Team::create($attr);
        // Participant::create($attr); IN CASE 1 PAGE CREATION
        session()->flash('success', 'Team Registration Success');
        return redirect('/');
    }




    public function show(Team $team)
    {
        return view('teams.show', compact('team'));
    }




    public function edit(Team $team)
    {
        return view('teams.edit', compact('team'));
    }




    public function update(TeamRequest $request, Team $team)
    {
        $attr = $request->all();
        $team->update($attr);
        session()->flash('success', "Team Update Success");
        return redirect('/');
    }




    public function destroy(Team $team)
    {
        $team->delete();
        session()->flash('success', "Team Delete Success");
        return redirect('/');
    }
}
