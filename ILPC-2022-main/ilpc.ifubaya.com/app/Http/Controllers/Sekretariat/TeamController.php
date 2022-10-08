<?php

namespace App\Http\Controllers\Sekretariat;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Team;
use Illuminate\Http\Client\Request as ClientRequest;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        if(request("status") == "") return redirect()->to(route("sekretariat.teams.index")."?status%5B%5D=unverified&status%5B%5D=waiting&status%5B%5D=ready");
        else $status = request("status");

        $statusAvailable = ["ready", "waiting", "unverified"];
        if(count(array_intersect($status, $statusAvailable)) != count($status)) abort(404);
        
        $teams = Team::where("status", "!=", "deactivated")->whereIn("status", $status)->orderBy("id", "desc")->paginate(12);
        return view("sekretariat.teams.registration.index", compact("teams"));
    }

    public function teamsReadMore()
    {    
        $team_id = request('team_id');
        $team = Team::find($team_id);
        $teacher = Teacher::find($team->teacher_id);
        $school = School::find($teacher->school_id);
        $participants = Participant::where('team_id', $team_id)->get();
        return response()->json(array(
            'team' => $team,
            'school' => $school,
            'participants' => $participants,
        ), 200);
    }

    public function teamsShowBuktiTransfer(){
        $team_id = request('team_id');
        $team = Team::find($team_id);
        return response()->json(array(
            'team' => $team,
        ), 200);
    }

    public function verifiedBuktiTransfer(){
        Team::where('id',request('team_id'))->update(['status'=>'ready']);
        return response()->json(array(
            'msg' => 'berhasil',
        ), 200);
    }

    public function unverifiedBuktiTransfer(){
        Team::where('id',request('team_id'))->update(['status'=>'unverified']);
        return response()->json(array(
            'msg' => 'berhasil',
        ), 200);
    }

    public function participantShowKartuPelajar(){
        $participant_id = request('participant_id');
        $participant = Participant::find($participant_id);
        $team = Team::find($participant->team_id);
        $teacher = Teacher::find($team->teacher_id);
        $school = School::find($teacher->school_id);

        return response()->json(array(
            'participant' => $participant,
            'school' => $school,
        ), 200);
    }

    public function teamsDeactivate(Team $team)
    {
        $team->update(["status" => "deactivated"]);
        session()->flash("success", "Team $team->nama successfully deactivated");
        return redirect()->back();
    }

    public function search(Request $request)
    {
        $request->validate([
            'searchBy' => 'required',
            'status' => 'required'
        ]);

        $searchBy = $request->get('searchBy');
        $searchByAvailable = ["teams.nama", "schools.nama", "participants.nama"];
        if (!in_array($searchBy, $searchByAvailable)) abort(404);

        $keyword = $request->get('keyword');
        
        $status = $request["status"];
        $statusAvailable = ["ready", "waiting", "unverified"];
        if(count(array_intersect($status, $statusAvailable)) != count($status)) abort(404);


        $teams = Team::select("teams.*")
            ->distinct()
            ->join('teachers', "teachers.id", "=", "teams.teacher_id")
            ->join('schools', "schools.id", "=", "teachers.school_id")
            ->join('participants', "participants.team_id", "=", "teams.id")
            ->where("$searchBy", 'LIKE', "%$keyword%")->orderBy('teams.id', 'desc')
            ->whereIn("teams.status", $status)
            ->orderBy("teams.id", "desc")
            ->paginate(12);

        session()->flash("keyword", $keyword);

        return view("sekretariat.teams.registration.index", compact('teams'));
    }


}
