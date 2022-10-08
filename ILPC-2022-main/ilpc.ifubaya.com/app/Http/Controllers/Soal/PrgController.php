<?php

namespace App\Http\Controllers\Soal;

use App\Http\Controllers\Controller;
use App\Models\PrgContests;
use App\Models\PrgQuestions;
use App\Models\PrgSubmissions;
use App\Models\Team;
use App\Events\UpdateScoreboard;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PHPUnit\Util\Json;

class PrgController extends Controller
{
    public function search_contest(Request $request)
    {
        // dd($request);
        $keyword = $request['keyword'];
        $contests = PrgContests::where("nama", "LIKE", "%$keyword%")->paginate(12);

        session()->flash("keyword", $keyword);

        return view('soal.programming.index', compact('contests'));
    }

    public function show_submission(PrgContests $contest)
    {
        // $submissions = PrgQuestions::select()
        //                 ->join('prg_submissions','prg_submissions.prg_question_id','=','prg_questions.id')
        //                 ->join('teams','prg_submissions.team_id','=','teams.id')
        //                 ->where("prg_contest_id","=",$contest->id)->orderBy("waktu_submit","DESC")
        //                 ->paginate(25);

        // Need to select spesifically submission_id, because "join" will ruined which ID will be picked (whether question,contest, or submission id)
        $submissions = PrgSubmissions::join("prg_questions", 'prg_submissions.prg_question_id', '=', 'prg_questions.id')
            ->where("prg_contest_id", "=", $contest->id)->orderBy("waktu_submit", "DESC")->select('*', 'prg_submissions.id as submission_id')
            ->paginate(25);

        return view('soal.programming.submission.index', compact('contest', 'submissions'));
    }

    public function show_contest(PrgContests $contest)
    {
        $questions = $contest->prgQuestions()->orderBy('nomor', 'asc')->get();
        $admin = $contest->admin()->first(); //Get the first admin

        return view('soal.programming.show', compact('questions', 'contest', 'admin'));
    }

    public function create_contest()
    {
    }

    public function store_contest(Request $request)
    {
        // dd($request);
        PrgContests::create(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'scoreboard_freeze' => $request["scoreboard_freeze"],
                'scoreboard_status' => $request["scoreboard_status"],
                // 'scoreboard_slug' => Str::slug($request["nama"], "-"),
                'scoreboard_slug' => Str::slug(Str::lower($request["nama"]) . Str::random(8), "-"),
                'admin_id' => auth()->user()->admin->id,
                'slug' => Str::slug(Str::lower($request["nama"]) . Str::random(8), "-"),
            ],
        );

        session()->flash('success', 'New Programming Contest Succesfully Created');
        return redirect()->to(route('soal.prg.index'));
    }

    public function edit_contest()
    {
    }

    public function update_contest(Request $request, PrgContests $contest)
    {
        // dd($request);
        $contest->update(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'scoreboard_freeze' => $request["scoreboard_freeze"],
                'scoreboard_status' => $request["scoreboard_status"],
                // 'scoreboard_slug' => Str::slug($request["nama"], "-"),
                // 'admin_id' =>  auth()->user()->id,
            ],
        );

        session()->flash("success", "contest $contest->id successfully updated");
        return redirect()->to(route('soal.prg.show', $contest->id));
    }

    public function destroy_contest(PrgContests $contest)
    {
        $questions = $contest->prgQuestions()->get();
        foreach ($questions as $question) {
            File::delete($question->input);
            File::delete($question->output);
        }
        // TODO Add Delete Submission when Destroy Contest
        $contest->delete();
        session()->flash('success', 'Contest Sucesfully Deleted');
        return redirect()->back();
    }

    public function show_participant(PrgContests $contest)
    {
        $all_teams = Team::all()->where('status', 'ready');
        $teams = $contest->teams()->paginate(25);

        return view('soal.programming.participant.index', compact('contest', 'all_teams', 'teams'));
    }

    public function store_participant(PrgContests $contest, Request $request)
    {
        $team_id = $request['team_id'];
        $contest->teams()->sync($team_id, false);
        session()->flash('success', 'Participant Sucesfully Added');
        return back();
    }

    public function destroy_participant(PrgContests $contest, Team $team)
    {
        $contest->teams()->detach($team->id);
        session()->flash('success', 'Participant Sucesfully Deleted');
        return back();
    }

    public function create_question(PrgContests $contest)
    {
        return view('soal.programming.question.create', compact('contest'));
    }

    public function store_question(PrgContests $contest, Request $request)
    {
        // dd(request());
        $prgQuestions = new PrgQuestions();
        $prgQuestions->nomor = $request['nomor'];
        $prgQuestions->judul = $request['judul'];
        $prgQuestions->isi = $request['isi'];
        $prgQuestions->time_limit = $request['time_limit'];

        $prgQuestions->prg_contest_id = $contest->id;

        // Upload Files disini
        // $request->validate([
        //     'input_file' => 'mimes:in',
        //     'output_file' => 'mimes:out',
        // ]);
        $prgQuestions->save();

        if (request()->hasFile('input_file') && request()->hasFile('output_file')) {
            // Nama file = time_id.in / time_id.out
            $file = $request->file("input_file");
            $file_name_in =  time() . "_" . $prgQuestions->id . '.in';
            $file->storeAs('public/prg/soal/', $file_name_in, ['disks' => 'public']);


            $file = $request->file("output_file");
            $file_name_out =  time() . "_" . $prgQuestions->id . '.out';
            $file->storeAs('public/prg/soal/', $file_name_out, ['disks' => 'public']);

            // Ubah format dos2unix just in case
            $inputSoal = public_path() . '/' . 'storage/prg/soal/' . $file_name_in;
            $outputSoal = public_path() . '/' . 'storage/prg/soal/' . $file_name_out;
            shell_exec("dos2unix $inputSoal");
            shell_exec("dos2unix $outputSoal");

            $prgQuestions->input = 'storage/prg/soal/' . $file_name_in;
            $prgQuestions->output = 'storage/prg/soal/' . $file_name_out;
            $prgQuestions->save();
        }

        session()->flash('success', 'New Question Sucesfully Created');
        return redirect()->route('soal.prg.show', $contest->id);
    }

    public function edit_question(PrgContests $contest, PrgQuestions $question)
    {
        return view('soal.programming.question.edit', compact('contest', 'question'));
    }

    public function update_question(PrgContests $contest, PrgQuestions $question,  Request $request)
    {
        $question->nomor = $request['nomor'];
        $question->judul = $request['judul'];
        $question->isi = $request['isi'];
        $question->time_limit = $request['time_limit'];

        //Upload Files disini
        // $request->validate([
        //     'input_file' => 'mimes:in',
        //     'output_file' => 'mimes:out',
        // ]);

        $file_name = Str::slug($request["judul"], "-");

        if (request()->hasFile('input_file')) {
            // Nama file = time_id.in
            File::delete($question->input);
            $file = $request->file("input_file");
            $file_name_in =  time() . "_" . $question->id . '.in';
            $file->storeAs('public/prg/soal/', $file_name_in, ['disks' => 'public']);
            $question->input = 'storage/prg/soal/' . $file_name_in;

            // Ubah format dos2unix just in case
            $inputSoal = public_path() . '/' . 'storage/prg/soal/' . $file_name_in;
            shell_exec("dos2unix $inputSoal");
        }

        if (request()->hasFile('output_file')) {
            // Nama file = time_id.out
            File::delete($question->output);
            $file = $request->file("output_file");
            $file_name_out =  time() . "_" . $question->id . '.out';
            $file->storeAs('public/prg/soal/', $file_name_out, ['disks' => 'public']);
            $question->output = 'storage/prg/soal/' . $file_name_out;
            
            // Ubah format dos2unix just in case
            $outputSoal = public_path() . '/' . 'storage/prg/soal/' . $file_name_out;
            shell_exec("dos2unix $outputSoal");
        }

        $question->save();

        session()->flash('success', 'Question ' . $question->nomor . ' Sucesfully Edited');
        return redirect()->route('soal.prg.show', $contest->id);
    }

    public function destroy_question(Request $request)
    {
        $question = PrgQuestions::find($request['id']);
        File::delete($question->input);
        File::delete($question->output);
        $question->delete();
        session()->flash('success', 'Question Sucesfully Deleted');
        return redirect()->back();
    }

    public function show_scoreboard(PrgContests $contest, Request $request)
    {
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

        return view('soal.programming.scoreboard.index', compact('contest', 'questions', 'teams', 'total'));
    }

    public function rejudge_question(PrgQuestions $question)
    {
        return redirect()->back();
    }

    public function judge_submission(PrgContests $contest, PrgSubmissions $submission, Request $request)
    {
        $team = $submission->team;
        $question = $submission->prgQuestion;
        $time_limit = $question->time_limit;

        $accepted = (isset($submission->team->prgSubmissions)) ? 
        $submission->team->prgSubmissions()
            ->join('prg_questions', 'prg_submissions.prg_question_id', '=', 'prg_questions.id')
            ->where('prg_question_id', '=', $question->id)
            ->where('status', '=', 'Accepted')
            ->count() : 0;

        if($accepted > 0) {
            // Kalo sebelumnya dah ada submission dari team yang lagi login di contest ini, maka $output['result] = 'Solved'
            // "(select status 
            //         from prg_submissions 
            //         where prg_question_id = p.id 
            //         and team_id= '" . $team->id . "'
            //         order by id desc
                    // limit 1) as 'status'," ;
            $output['result'] = 'Solved';
            $output['runtime'] = 0;
        } else {
            $output = $this->judge($submission, $time_limit);
        }
        $submission->status = $output['result'];
        $submission->runtime = $output['runtime'];

        // Update Penalti
        if ($output['result'] == 'Accepted') {
            $attempt = DB::select(DB::raw(
                // Banyak Attempt yang salah dari suatu question
                "select count(*) as 'wrong_attempt'
                    from prg_submissions 
                    where prg_question_id = " . $question->id . " 
                    and team_id = '" . $team->id . "'
                    and status != 'Solved'
                    and status != 'Accepted' 
                    and status != 'Pending' 
                    and status != 'Judging'"
            ));
            $selisih = Carbon::parse($contest->jadwal_mulai)->diffInMinutes(Carbon::parse($submission->waktu_submit));
            $submission->penalti = (20 * $attempt[0]->wrong_attempt) + $selisih;
        }
        $submission->save();

        // $jadwal_freeze = DB::select(DB::raw("SELECT DATE_ADD('" . $contest->jadwal_selesai . "', INTERVAL -" . $contest->scoreboard_freeze . " MINUTE) AS waktu"));
        // $jadwal_freeze[0]->waktu;
        // If now() <= jadwal_selesai - scoreboardfreeze >= 
        $jadwal_freeze = Carbon::parse($contest->jadwal_selesai)->subMinutes($contest->scoreboard_freeze)->toDateTimeString();
        if(Carbon::now()->gt($jadwal_freeze))
            event(new UpdateScoreboard("soal"));
        else
            event(new UpdateScoreboard("pemainAndSoal"));
        return back();
    }

    private function judge($submission, $time_limit)
    {
        $result = "Accepted";
        $runtime = 0;

        // Append in front with GLOBAL PATH (/var/www/...)
        // so it can be executed in Controller, and the output can be in a different folder.
        // Output example : /var/www/html/ILPC-2022/ilpc.ifubaya.com/public/storage/prg/soal/nomor1.in
        $inputSoal = public_path() . '/' . $submission->prgQuestion->input;
        $outputSoal = public_path() . '/' . $submission->prgQuestion->output;
        $programPeserta = public_path() . '/' . $submission->filename;
        $tempPath = public_path() . '/storage/prg/temp';

        $tempHasil = '<br>Kontes : ' . $submission->prgQuestion->prgContest->nama . '<br>Pertanyaan : ' . $submission->prgQuestion->judul . '<br>Input : ' . $inputSoal . '<br> Output : ' . $outputSoal . '<br> Program : ' . $programPeserta . '<br> Temp : ' . $tempPath . '<br> Submission Bahasa : ' . $submission->bahasa . '<br>';
        echo $tempHasil;

        // Command1 for compiling
        // Command2 for timing and result
        if ($submission->bahasa == "cpp") {
            $command1 = "clang++ $programPeserta -o $tempPath/compiled_cpp";
            $command2 = "time $tempPath/compiled_cpp <$inputSoal> $tempPath/result.out";
        } else if ($submission->bahasa == "java") {
            $command1 = "javac $programPeserta -d $tempPath";
            $command2 = "time java -cp $tempPath Main <$inputSoal> $tempPath/result.out";
        } else if ($submission->bahasa == "pascal") {
            $command1 = "fpc $programPeserta -o'$tempPath/compiled_pascal'";
            $command2 = "time $tempPath/compiled_pascal <$inputSoal> $tempPath/result.out";
        } else if ($submission->bahasa == "python") {
            $command1 = ""; // Python doesn't need to be compiled
            $command2 = "time python3 $programPeserta < $inputSoal";
        }
        $descriptorspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));

        // If the language needs to be compiled, execute compile1
        if ($command1 != "") {
            $process = proc_open($command1, $descriptorspec, $pipes);
            if (is_resource($process)) {
                $out = stream_get_contents($pipes[1]);
                echo "1." . $out . "<br />";
                fclose($pipes[1]);

                $out = stream_get_contents($pipes[2]);
                echo "2." . $out . "<br />";
                fclose($pipes[2]);

                if (proc_close($process) != 0) $result = 'Compile Error';
            }
        }

        // If the result still accepted, execute compile2
        if ($result == "Accepted") {
            $memory_limit = 64 * 1024; //64M

            $process = proc_open("bash -c 'ulimit -St $time_limit -Sm $memory_limit ; $command2'", $descriptorspec, $pipes);
            if (is_resource($process)) {
                $stream = stream_get_contents($pipes[2]);
                echo "2." . $stream . "<br />";
                fclose($pipes[2]);

                $timelimitstring = "CPU time limit exceeded";
                $memorylimitstring = "Memory size limit exceeded";

                if (strstr($stream, $timelimitstring) != null) $result = 'Time Limit Exceeded';
                if (strstr($stream, $memorylimitstring) != null) $result = "Memory Limit Exceeded";
                if ($result == "Accepted" && substr($stream, 1, 4) != "real") $result = "Run Time Error";
                if ($result == "Accepted" && $command1 == "") { // If the language does not need to be compiled, then php will write the output
                    $streamOutput = stream_get_contents($pipes[1]);
                    fclose($pipes[1]);
                    $output = fopen("$tempPath/result.out", "w");
                    fwrite($output, $streamOutput);
                    fclose($output);
                }

                $str = strstr($stream, "real");
                $str = str_replace(",", ".", $str);
                $im = strpos($str, "m");
                $is = strpos($str, "s");
                $m = substr($str, 5, $im - 5);
                $s = substr($str, $im + 1, $is - $im - 1);
                $runtime = number_format($m * 60 + $s, 3);

                proc_close($process);
            }
        }

        // If the result is still accepted after command2, compare the submission result with question out
        if ($result == "Accepted") {
            $process = proc_open("diff --strip-trailing-cr --ignore-blank-lines $tempPath/result.out $outputSoal", $descriptorspec, $pipes);
            $out = stream_get_contents($pipes[1]);
            echo "1." . $out . "<br />";
            fclose($pipes[1]);

            $out = stream_get_contents($pipes[2]);
            echo "2." . $out . "<br />";
            fclose($pipes[2]);

            if (is_resource($process)) {
                $return_value = proc_close($process);
                if ($return_value != 0) $result = "Wrong Answer";
            }

            shell_exec("rm -r $tempPath/*");
        }

        echo "result : " . $result . "<br />";
        echo "runtime : " . $runtime . "<br />";

        return compact('result', 'runtime');
    }
}
