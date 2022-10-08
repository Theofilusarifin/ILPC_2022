<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Models\McContests;
use App\Models\McQuestions;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class McController extends Controller
{
    private function authorizeAccess($contest){
        $team_join = McContests::join('team_join_mc_contest', 'team_join_mc_contest.mc_contest_id', '=', 'mc_contests.id')
        ->where('mc_contest_id', "=", $contest->id)
        ->where('team_id', "=", Auth::user()->team->id)
        ->get();
        if($contest->jadwal_mulai >= Carbon::now() || $contest->jadwal_selesai <= Carbon::now() || $team_join->isEmpty() || $team_join[0]->waktu_bergabung == null || $team_join[0]->waktu_selesai != null) abort(405, 'Contest Time is Over');
    } 
    public function show(McContests $contest, $nomor)
    {
        $this->authorizeAccess($contest);
        //To Do: urutkan sesuai nomor
        $questions = $contest->mcQuestions()->orderBy('nomor','ASC')->get();
        $nomor_terakhir = $questions->max('nomor');
        $previous = $questions->where('nomor', '<', $nomor)->max('nomor');
        $next = $questions->where('nomor', '>', $nomor)->min('nomor');

        $questionNow = $questions->where('nomor', '=', $nomor)->first();
        $currentSubmission = $questionNow->teams()->where('team_id', '=', Auth::user()->team->id)->first();
        
        // dd($currentAnswer);
        return view("pemain.soal.mc.index", compact('contest', 'questions', 'previous', 'next', 'nomor', 'nomor_terakhir', 'questionNow', 'currentSubmission'));
    }

    public function store_submission(Request $request)
    {
        $questionNow = McQuestions::find($request['question_id']);
        $contest = $questionNow->mcContest;

        $this->authorizeAccess($contest);
        $jawaban = $request['jawaban'];
        $keyakinan = $request['keyakinan'];

        if (isset($jawaban) && isset($keyakinan)) {
            $team_id = Auth::user()->team->id;
            //Get Jawaban Benar
            $jawabanBenar = $questionNow->jawaban_benar;
            
            $kebenaran = strtolower($jawaban) == strtolower($jawabanBenar) ? true : false;

            //Get Skor
            if ($kebenaran == true && $keyakinan == "1")
                $skor = 5;
            else if ($kebenaran == true && $keyakinan == "0")
                $skor = 3;
            else if ($kebenaran == false && $keyakinan == "1")
                $skor = -3;
            else if ($kebenaran == false && $keyakinan == "0")
                $skor = -1;
            else
                $skor = 0;

            $questionNow->teams()->sync([
                $team_id =>
                [
                    'jawaban' => $jawaban,
                    'keyakinan' => $keyakinan,
                    'skor' => $skor
                ],
            ], false);
        }

        // Navigation
        $nomor = $request["tujuan"];

        $contest_id = $contest->id;
        $total_skor = Auth::user()->team->mcQuestions->where('mc_contest_id', '=', $contest_id)->sum("pivot.skor");
        Auth::user()->team->mcContests()->sync([$contest_id => ['total_skor' => $total_skor]], false);

        // Jika bukan submit, di return langsung
        if ($nomor != 'end') return redirect(route('pemain.contest.mc', [$contest->slug, $nomor]));
        
        // Jika end attempt, update total skor & waktu selesai
        Auth::user()->team->mcContests()->sync([$contest_id => ['waktu_selesai' => Carbon::now()]],false);
        session()->flash("success", "You have finished your attempt");
        return redirect(route('pemain.contest'));
    }
}
