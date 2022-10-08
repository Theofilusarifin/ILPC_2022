<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionRequest;
use App\Models\EssayContests;
use App\Models\EssayQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EssayController extends Controller
{
    private function authorizeAccess($contest){
        $team_join = EssayContests::join('team_join_essay_contest', 'team_join_essay_contest.essay_contest_id', '=', 'essay_contests.id')
        ->where('essay_contest_id', "=", $contest->id)
        ->where('team_id', "=", Auth::user()->team->id)
        ->get();
        if($contest->jadwal_mulai >= Carbon::now() || $contest->jadwal_selesai <= Carbon::now() || $team_join->isEmpty() || $team_join[0]->waktu_bergabung == null || $team_join[0]->waktu_selesai != null) abort(405, 'Contest Time is Over');
    } 

    public function show(EssayContests $contest){
        $this->authorizeAccess($contest);
        $question = $contest->essayQuestions()->orderBy('nomor','ASC')->get();
        return view("pemain.soal.essay.index", compact('contest', 'question'));
    }

    public function uploadAnswer(EssayContests $contest, SubmissionRequest $request){
        $this->authorizeAccess($contest);
        if (request()->hasFile('answer_file')) {
            $file = $request->file("answer_file");
            $file_extension = $request->file("answer_file")->getClientOriginalExtension();
            if ($file_extension != "pdf"){
                session()->flash("error", "Answer file was not in correct format!");
                return back();
            }
            $team_name = Auth::user()->team->nama;
            $file_name = $team_name."_".$contest->nama.'.pdf';
            $file->storeAs('public/answer/essay/'.$contest->nama.$team_name.'/', $file_name, ['disks' => 'public']);

            Auth::user()->team->essayContests()->sync([
                $contest->id => [
                    'submission_filename' => 'storage/answer/essay/'.$contest->nama.$team_name."/". $file_name, 
                    'waktu_selesai' => Carbon::now()]
            ],false);

            session()->flash("success", "Your answer successfully submitted!");
            return redirect()->to(route('pemain.contest'));
        }

        else{
            session()->flash("error", "No file is submitted!");
            return redirect()->back();
        }
    }
}
