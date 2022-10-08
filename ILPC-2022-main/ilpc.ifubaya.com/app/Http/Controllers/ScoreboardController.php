<?php

namespace App\Http\Controllers;

use App\Models\PrgContests;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ScoreboardController extends Controller
{
    public function getScoreboard(Request $request)
    {
        $contest = PrgContests::find($request['contest_id']);
        // Buat ambil seluruh soal (Buat TH di scoreboard)
        $questions = $contest->prgQuestions()->orderBy('nomor', 'asc')->get();

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
                where ps.team_id = " . $team->id . "
                and pc.id = " . $contest->id . "
                and ps.status = 'Accepted'"
            ));

            // Total Penalti (Time)
            $total_penalti = DB::select(DB::raw(
                "select ifnull(sum(penalti), 0) as 'total_penalti'
                from prg_submissions ps
                join prg_questions pq on ps.prg_question_id = pq.id
                join prg_contests pc on pq.prg_contest_id = pc.id
                where ps.team_id = " . $team->id . "
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
                    and team_id= '" . $team->id . "'
                    order by id desc
                    limit 1) as 'status'," .

                    // Banyak Attempt dari suatu question
                    "(select count(*) 
                    from prg_submissions 
                    where prg_question_id = p.id 
                    and team_id= '" . $team->id . "' 
                    and status != 'Solved' 
                    and status != 'Pending' 
                    and status != 'Judging') as 'attempt'," .

                    // Total Penalti dari suatu question
                    "ifnull((select penalti 
                    from prg_submissions 
                    where prg_question_id = p.id 
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
                    where ps.team_id = " . $team->id . "
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
                    where ps.team_id = " . $team->id . "
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
            where prg_question_id = p.id 
            and status !='Solved' 
            and status !='Pending' 
            and status !='Judging') as 'total_attempt'," .

            // Total Jumlah Benar dari suatu Soal
            "(select count(*)
            from prg_submissions
            where prg_question_id = p.id 
            and status = 'Accepted') as 'total_JB'
            
            from prg_questions p
            where prg_contest_id = ". $contest->id ." 
            order by p.nomor asc"
        ));         

        return response()->json(array(
            'contest' => $contest,
            'questions' => $questions,
            'teams' => $teams,
            'total' => $total,
        ), 200);
    }
}
