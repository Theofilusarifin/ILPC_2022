<?php

namespace App\Http\Controllers\Soal;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\EssayContests;
use App\Models\EssayQuestions;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EssayController extends Controller
{

    public function search_contest(Request $request)
    {
        $keyword =$request['keyword'];
        $contests = EssayContests::where("nama","LIKE","%$keyword%")->paginate(12);

        session()->flash("keyword", $keyword);

        return view('soal.essay.index', compact('contests'));
    }

    
    public function show_contest(EssayContests $contest)
    {
        $questions = $contest->essayQuestions()->orderBy('nomor', 'asc')->get();
        $admin = $contest->admin()->first(); //Get the first admin
        // $contest = EssayContests::where('id', $contest->id)->get();

        return view('soal.essay.show', compact('questions', 'contest', 'admin'));
    }

    public function show_submission(EssayContests $contest, Request $request){
        
        $submissions = EssayContests::join('team_join_essay_contest','team_join_essay_contest.essay_contest_id','=','essay_contests.id')
                        ->join('teams','team_join_essay_contest.team_id','=','teams.id')
                        ->where("essay_contest_id","=",$contest->id)->orderBy("team_join_essay_contest.waktu_bergabung","DESC")
                        ->where("teams.nama","LIKE","%".$request['keyword']."%")
                        ->where("team_join_essay_contest.submission_filename","!=","null")
                        ->paginate(25);
        // dd($submissions);
        return view('soal.essay.submission.index', compact('contest','submissions'));
    }

    public function store_contest(Request $request)
    {
        EssayContests::create(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'admin_id' => auth()->user()->admin->id,
                'slug' => Str::slug(Str::lower($request["nama"]).Str::random(8) , "-"),
            ],
        );

        session()->flash('success', 'New Essay Contest Succesfully Created');
        return redirect()->to(route('soal.essay.index'));
    }

    public function update_contest(Request $request, EssayContests $contest)
    {
        $contest->update(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                // 'admin_id' =>  auth()->user()->id,
            ],
        );

        session()->flash("success", "contest $contest->id successfully updated");
        return redirect()->to(route('soal.essay.show',$contest->id));
    }

    public function update_total_skor(Request $request, EssayContests $contest)
    {
        $affected = DB::table('team_join_essay_contest')
        ->where('essay_contest_id','=',$contest->id)
        ->where('team_id','=',$request['team_id'])
        ->update(['total_skor' => $request["total_skor"]]);

        $affected > 0 ? session()->flash("success", "Total Skor successfully updated") : session()->flash("failed", "Update Total Skor failed");
        return redirect()->to(route('soal.essay.submission',$contest->id));
    }

    public function destroy_contest(EssayContests $contest)
    {
        $contest->delete();
        session()->flash('success', "Essay Contest ID $contest->id successfully deleted");
        return redirect()->to(route('soal.essay.index'));
    }

    public function show_participant(EssayContests $contest)
    {
        $all_teams = Team::all()->where('status', 'ready');
        $teams = $contest->teams()->paginate(25);
        return view('soal.essay.participant.index', compact('contest', 'all_teams', 'teams'));
    }

    public function store_participant(EssayContests $contest, Request $request)
    {
        $team_id = $request['team_id'];
        $contest->teams()->sync($team_id, false);
        session()->flash('success', 'Participant Successfully Added');
        return back();
    }

    public function destroy_participant(EssayContests $contest, Team $team)
    {
        $contest->teams()->detach($team->id);
        session()->flash('success', 'Participant Successfully Deleted');
        return back();
    }

    public function create_question(EssayContests $contest)
    {
        return view('soal.essay.question.create', compact('contest'));
    }

    public function store_question(EssayContests $contest, Request $request)
    {
        $essayQuestions = new EssayQuestions();
        $essayQuestions->nomor = $request['nomor'];
        $essayQuestions->isi = $request['isi'];
        $essayQuestions->essay_contest_id = $contest->id;
        $essayQuestions->save();
        session()->flash('success', 'New Question Successfully Created');
        return redirect()->route('soal.essay.show', $contest->id);
    }

    public function destroy_question(Request $request)
    {
        $question = EssayQuestions::find($request['id']);
        $question->delete();
        session()->flash('success', 'Question Successfully Deleted');
        return redirect()->back();
    }


}