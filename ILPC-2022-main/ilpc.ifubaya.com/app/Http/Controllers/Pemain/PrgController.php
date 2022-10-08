<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubmissionRequest;
use Illuminate\Http\Request;
use App\Models\PrgContests;
use App\Models\PrgQuestions;
use App\Models\PrgSubmissions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PrgController extends Controller
{
    private function authorizeAccess($contest){
        $team_join = PrgContests::join('team_join_prg_contest', 'team_join_prg_contest.prg_contest_id', '=', 'prg_contests.id')
        ->where('prg_contest_id', "=", $contest->id)
        ->where('team_id', "=", Auth::user()->team->id)
        ->get();
        if($contest->jadwal_mulai >= Carbon::now() || $contest->jadwal_selesai <= Carbon::now() || $team_join->isEmpty() || $team_join[0]->waktu_bergabung == null || $team_join[0]->waktu_selesai != null) abort(405, 'Contest Time is Over');
    }

    public function index(PrgContests $contest){
        $this->authorizeAccess($contest);

        $questions = $contest->prgQuestions()->orderBy('nomor','ASC')->get();;
        $index = 0;
        foreach ($questions as $question) {
            $submission = PrgSubmissions::where('team_id', "=", Auth::user()->team->id)
            ->where('prg_question_id', "=", $question->id)
            ->orderby('id', 'DESC')
            ->first();
            $questions[$index]->submission = $submission;
            $index++;
        }

        return view("pemain.soal.programming.index", compact('contest', 'questions'));
    }

    public function show(PrgContests $contest, PrgQuestions $question){
        $this->authorizeAccess($contest);
        return view("pemain.soal.programming.show", compact('contest', 'question'));
    }
    
    public function submission(PrgContests $contest){
        $this->authorizeAccess($contest);

        $submissions = PrgSubmissions::where('team_id', "=", Auth::user()->team->id)
        ->join('prg_questions', 'prg_questions.id', 'prg_submissions.prg_question_id')
        ->get();

        // dd($submissions);
        return view("pemain.soal.programming.submission_history", compact('contest', 'submissions'));
    }

    public function scoreboard(PrgContests $contest){
        $this->authorizeAccess($contest);

        // Buat ambil seluruh soal (Buat TH di scoreboard)
        $questions = $contest->prgQuestions()->orderBy('nomor', 'asc')->get();

        $jadwal_freeze = Carbon::parse($contest->jadwal_selesai)->subMinutes($contest->scoreboard_freeze)->toDateTimeString();

        // Semua Tim yang join di contest tertentu
        $teams = DB::select(DB::raw(
            "select distinct t.id, t.nama AS nama_tim, s.nama AS sekolah, r.nama AS kota
            from team_join_prg_contest tpc
            inner join teams t on tpc.team_id = t.id
            inner join prg_contests pc on tpc.prg_contest_id = " . $contest->id . "  
            inner join teachers te on t.teacher_id = te.id
            inner join schools s on te.school_id = s.id
            inner join regencies r on s.regency_id = r.id"
        ));

        $index = 0;
        foreach ($teams as $team) {
            // Mengambil jumlah benar dari suatu team terhadap contest tertentu
            $JB = DB::select(DB::raw(
                "select count(*) as 'JB' 
                from prg_submissions ps
                join prg_questions pq on ps.prg_question_id = pq.id
                join prg_contests pc on pq.prg_contest_id = pc.id
                where ps.waktu_submit <= '" . $jadwal_freeze . "'
                and ps.team_id = " . $team->id . "
                and pc.id = " . $contest->id . "
                and ps.status = 'Accepted'"
            ));

            // Total Penalti (Time)
            $total_penalti = DB::select(DB::raw(
                "select ifnull(sum(penalti), 0) as 'total_penalti'
                from prg_submissions ps
                join prg_questions pq on ps.prg_question_id = pq.id
                join prg_contests pc on pq.prg_contest_id = pc.id
                where ps.waktu_submit <= '" . $jadwal_freeze . "'
                and ps.team_id = " . $team->id . "
                and pc.id = " . $contest->id . " 
                and ps.status= 'Accepted'"
            ));

            $teams[$index]->JB = $JB[0]->JB;
            $teams[$index]->total_penalti = $total_penalti[0]->total_penalti;

            $index++;
        }

        // Sorting Ranking pemain berdasarkan jumlah benar dan total penali
        array_multisort(
            array_column($teams, 'JB'), SORT_DESC,
            array_column($teams, 'total_penalti'), SORT_ASC,
        $teams);

        $index = 0;
        foreach ($teams as $team) {

            // Total hasil dari tiap tim
            $team_question = DB::select(DB::raw(
                // Nomor Question
                "select p.nomor as nomor_soal," .

                    // Status Question (Ambil dari submission terakhir)
                    "(select status 
                    from prg_submissions 
                    where prg_question_id = p.id 
                    and waktu_submit <= '" . $jadwal_freeze . "'
                    and team_id= '" . $team->id . "'
                    order by id desc
                    limit 1) as 'status'," .

                    // Banyak Attempt dari suatu question
                    "(select count(*) 
                    from prg_submissions 
                    where waktu_submit <= '" . $jadwal_freeze . "'
                    and prg_question_id = p.id 
                    and team_id= '" . $team->id . "' 
                    and status != 'Solved' 
                    and status != 'Pending' 
                    and status != 'Judging') as 'attempt'," .

                    // Total Penalti dari suatu question
                    "ifnull((select penalti 
                    from prg_submissions 
                    where waktu_submit <= '" . $jadwal_freeze . "'
                    and prg_question_id = p.id 
                    and team_id = '" . $team->id . "' 
                    and status = 'Accepted'
                    order by waktu_submit ASC limit 1), -1) as 'total_penalti' 
                
                from prg_questions p 
                where prg_contest_id = " . $contest->id . " 
                order by nomor_soal asc"
            ));

            // dd($scoreboard);

            $total_attempt = DB::select(DB::raw(
                // Total Attempt dari suatu team
                "select count(*) AS 'total_attempt'
                    from prg_submissions ps
                    join prg_questions pq on ps.prg_question_id = pq.id
                    join prg_contests pc on pq.prg_contest_id = pc.id
                    where ps.waktu_submit <= '" . $jadwal_freeze . "'
                    and ps.team_id = " . $team->id . "
                    and pc.id = " . $contest->id . "
                    and status != 'Solved' 
                    and status != 'Pending' 
                    and status != 'Judging'
                    limit 1"
            ));

            $total_JB = DB::select(DB::raw(
                // Total Jumlah Benar (JB) dari suatu team
                "(select count(*) as 'total_JB' 
                    from prg_submissions ps
                    join prg_questions pq on ps.prg_question_id = pq.id
                    join prg_contests pc on pq.prg_contest_id = pc.id
                    where waktu_submit <= '" . $jadwal_freeze . "'
                    and ps.team_id = " . $team->id . "
                    and pc.id = " . $contest->id . "
                    and status = 'Accepted'
                    limit 1)"
            ));

            $teams[$index]->question = $team_question;
            $teams[$index]->total_attempt = $total_attempt;
            $teams[$index]->total_JB = $total_JB;

            $index++;
        }

        // Total hasil dari setiap soal
        $total = DB::select(DB::raw(
            "select" .

            // Total Attempt dari suatu Soal
            "(select count(*)
            from prg_submissions
            where waktu_submit <= '" . $jadwal_freeze . "'
            and prg_question_id = p.id 
            and status !='Solved' 
            and status !='Pending' 
            and status !='Judging') as 'total_attempt'," .

            // Total Jumlah Benar dari suatu Soal
            "(select count(*)
            from prg_submissions
            where waktu_submit <= '" . $jadwal_freeze . "'
            and prg_question_id = p.id 
            and status = 'Accepted') as 'total_JB'
            
            from prg_questions p
            where prg_contest_id = ". $contest->id ." 
            order by p.nomor asc"
        ));

        $contestType = "Programming";
        return view("pemain.soal.programming.scoreboard", compact('contest', 'contestType', 'questions', 'teams', 'total'));
    }

    public function storeAnswer(PrgContests $contest, PrgQuestions $question, SubmissionRequest $request){
        $this->authorizeAccess($contest);
        $prgSubmission = new PrgSubmissions(); 
        $prgSubmission->waktu_submit = Carbon::now(); //Waktu
        if (request()->hasFile('answer_file')) { //Check File ada atau tidak
            $file = $request->file("answer_file"); //Ambil file
            // dd($file);  
            $file_extension = $request->file("answer_file")->getClientOriginalExtension(); //Ambil extension
            // dd($file_extension);
            // Tentukan bahasa
            if($file_extension == "cpp") $prgSubmission->bahasa = "cpp";

            elseif($file_extension == "java") $prgSubmission->bahasa = "java";

            elseif($file_extension == "pas") $prgSubmission->bahasa = "pascal";

            elseif($file_extension == "py") $prgSubmission->bahasa = "python";

            else {
                session()->flash("error", "Answer file was not in correct format!");
                return back();
            }

            $team_username = Auth::user()->team->user->username; //Team name untuk folder
            $file_name = 'c'.$contest->id."_no".$question->id."_".$team_username.'_'.time().".".$file_extension; // nama file
            $file->storeAs('public/prg/submissions/'.$team_username.'/', $file_name, ['disks' => 'public']);
            $prgSubmission->filename = 'storage/prg/submissions/'.$team_username.'/'.$file_name;
            $prgSubmission->status = "Pending"; // Set status ke pending (Tunggu Judge)
            $prgSubmission->prg_question_id = $question->id; // Set question id
            $prgSubmission->team_id = Auth::user()->team->id; // Set Team Id

            // dd($prgSubmission);
            $prgSubmission->save(); // Save model

            session()->flash("success", "Your answer successfully submitted!");
            return redirect()->to(route('pemain.contest.prg', $contest->slug));
        }
        session()->flash("error", "No file is submitted!");
        return back();
    }

    public function finish_attempt(Request $request)
    {
        $contest = PrgContests::find($request['contest_id']);
        
        $this->authorizeAccess($contest);
        Auth::user()->team->prgContests()->sync([$request['contest_id'] => ['waktu_selesai' => Carbon::now()]],false);
        session()->flash("success", "You have finished your attempt");
        return redirect(route('pemain.contest'));
    }
}