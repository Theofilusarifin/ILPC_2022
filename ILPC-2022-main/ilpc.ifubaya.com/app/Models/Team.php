<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'status',
        'tgl_daftar',
        'bukti_transfer',
        'nominal',
        'login_token',
        'competition_id',
        'teacher_id',
    ];

    public function competition()
    {
        return $this->belongsTo(Competition::class, 'competition_id');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    public function team_reset_passwords()
    {
        return $this->hasMany(TeamResetPassword::class, 'team_id');
    }

    public function participants()
    {
        return $this->hasMany(Participant::class, 'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mcContests()
    {
        return $this->belongsToMany(McContests::class, 'team_join_mc_contest', 'team_id', 'mc_contest_id')
            ->withPivot(['waktu_bergabung', 'total_skor'])->withTimestamps();
    }

    public function mcQuestions()
    {
        return $this->belongsToMany(McQuestions::class, 'mc_submissions', 'team_id', 'mc_question_id')
            ->withPivot(['jawaban', 'keyakinan', 'skor'])->withTimestamps();
    }

    public function prgContests()
    {
        return $this->belongsToMany(PrgContests::class, 'team_join_prg_contest', 'team_id', 'prg_contest_id')
        ->withPivot(['waktu_bergabung', 'total_skor'])->withTimestamps();
    }

    public function prgSubmissions()
    {
        return $this->hasMany(PrgSubmissions::class, 'team_id');
    }

    public function essayContests()
    {
        return $this->belongsToMany(EssayContests::class, 'team_join_essay_contest', 'team_id', 'essay_contest_id')
            ->withPivot(['waktu_bergabung', 'total_skor', 'submission_filename'])->withTimestamps();
    }

    public function rallyGames()
    {
        return $this->belongsToMany(RallyGame::class, 'rg_score', 'team_id', 'rally_game_id')
            ->withPivot(['score'])->withTimestamps();
    }

    public function player(){
        return $this->hasOne(Player::class, 'team_id');
    }


    public static function McScoreboard($id_contest)
    {
        $data = Team::select('teams.nama AS nama_tim', 'schools.nama AS sekolah', 'regencies.nama AS kota', 'team_join_mc_contest.total_skor AS total_skor')
            ->join('team_join_mc_contest', "team_join_mc_contest.team_id", "=", "teams.id")
            ->join('mc_contests', "mc_contests.id", "=", "team_join_mc_contest.mc_contest_id")
            ->join('teachers', "teams.teacher_id", "=", "teachers.id")
            ->join('schools', "teachers.school_id", "=", "schools.id")
            ->join('regencies', "schools.regency_id", "=", "regencies.id")
            ->distinct()
            ->where('mc_contests.id', $id_contest)

            // Order By Sesuai Rank
            // ->orderBy('team_join_essay_contest.total_skor', 'desc')
            
            // Order By Sesuai Tim ID Supaya soal gampang rekap
            ->orderBy('teams.id', 'asc')
            
            ->get();
        return $data;
    }

    public static function EssayScoreboard($id_contest)
    {
        $data = Team::select('teams.nama AS nama_tim', 'schools.nama AS sekolah', 'regencies.nama AS kota', 'team_join_essay_contest.total_skor AS total_skor')
            ->join('team_join_essay_contest', "team_join_essay_contest.team_id", "=", "teams.id")
            ->join('essay_contests', "essay_contests.id", "=", "team_join_essay_contest.essay_contest_id")
            ->join('teachers', "teams.teacher_id", "=", "teachers.id")
            ->join('schools', "teachers.school_id", "=", "schools.id")
            ->join('regencies', "schools.regency_id", "=", "regencies.id")
            ->distinct()
            ->where('essay_contests.id', $id_contest)
            
            // Order By Sesuai Rank
            // ->orderBy('team_join_essay_contest.total_skor', 'desc')
            
            // Order By Sesuai Tim ID Supaya soal gampang rekap
            ->orderBy('teams.id', 'asc')
            
            ->get();
        return $data;
    }

    public static function PrgScoreboard($id_contest)
    {

        // Semua Tim yang join di contest tertentu
        $teams = DB::select(DB::raw(
            "select distinct t.id, t.nama AS nama_tim, s.nama AS sekolah, r.nama AS kota
            from team_join_prg_contest tpc
            inner join teams t on tpc.team_id = t.id
            inner join prg_contests pc on tpc.prg_contest_id = " . $id_contest . "  
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
                where team_id = " . $team->id . "
                and pc.id = " . $id_contest . "
                and status = 'Accepted'"
            ));

            // Total Penalti (Time)
            $total_penalti = DB::select(DB::raw(
                "select ifnull(sum(penalti), 0) as 'total_penalti'
                from prg_submissions ps
                join prg_questions pq on ps.prg_question_id = pq.id
                join prg_contests pc on pq.prg_contest_id = pc.id
                where team_id = " . $team->id . "
                and pc.id = " . $id_contest . " 
                and status= 'Accepted'"
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

        // Menghitung JJB Tiap Team
        $index = 0;
        foreach ($teams as $team) {
            $JJB = 0;
            $jumlahJB = $team->JB;
            $team_id_JJB = array();
            foreach ($teams as $team_jjb) {
                if ($team_jjb->JB == $jumlahJB){
                    $JJB++;
                    array_push($team_id_JJB, $team_jjb->id);
                }
            }
            $teams[$index]->JJB = $JJB;

            // Cari dia peringkat berapa berdasarkan JJB
            $PBJ = array_search($team->id, $team_id_JJB);
            // Tambah 1 karena index mulai dari 1
            $teams[$index]->PJB = $PBJ+1;

            // Hitung score totalnya
            $total_skor = round(($team->JB * 15) - ((($team->PJB-1)/$team->JJB) * 15),3);

            $teams[$index]->total_skor = $total_skor;

            $index++;
        }

        // Kalau mau sesuai rank comment ini
        array_multisort(
            array_column($teams, 'id'), SORT_ASC,
        $teams);

        return $teams;
    }
}
