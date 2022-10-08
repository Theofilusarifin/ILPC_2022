<?php

namespace App\Http\Controllers\Soal;

use App\Http\Controllers\Controller;
use App\Models\EssayContests;
use App\Models\McContests;
use App\Models\PrgContests;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Team;
use App\Models\TeamPrgContest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        $prg_contests = PrgContests::join('team_join_prg_contest', 'team_join_prg_contest.prg_contest_id', '=', 'prg_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '<=', Carbon::now())
        ->where('jadwal_selesai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();

        $mc_contests = McContests::join('team_join_mc_contest', 'team_join_mc_contest.mc_contest_id', '=', 'mc_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '<=', Carbon::now())
        ->where('jadwal_selesai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();
        
        $essay_contests = EssayContests::join('team_join_essay_contest', 'team_join_essay_contest.essay_contest_id', '=', 'essay_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '<=', Carbon::now())
        ->where('jadwal_selesai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();
        
        $active_contests = ["Programming" => $prg_contests, "Multiple Choice" => $mc_contests, "Essay" => $essay_contests];

        $prg_contests = PrgContests::join('team_join_prg_contest', 'team_join_prg_contest.prg_contest_id', '=', 'prg_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();
        
        $mc_contests = McContests::join('team_join_mc_contest', 'team_join_mc_contest.mc_contest_id', '=', 'mc_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();
        
        $essay_contests = EssayContests::join('team_join_essay_contest', 'team_join_essay_contest.essay_contest_id', '=', 'essay_contests.id')
        ->whereNull('waktu_selesai')
        ->where('jadwal_mulai', '>=', Carbon::now())
        ->groupBy('id')
        ->get();
        
        $upcoming_contests = ["Programming" => $prg_contests, "Multiple Choice" => $mc_contests, "Essay" => $essay_contests];

        return view("soal.index", compact('active_contests', 'upcoming_contests'));
        // return view('soal.index');
    }

    public function programming()
    {
        $contests = PrgContests::orderBy('id', 'desc')->paginate(12);
        return view('soal.programming.index', compact('contests'));
    }

    public function multipleChoice()
    {
        $contests = McContests::orderBy('id', 'desc')->paginate(12);
        return view('soal.multiple-choice.index', compact('contests'));
    }

    public function essay()
    {
        $contests = EssayContests::orderBy('id', 'desc')->paginate(12);
        return view('soal.essay.index', compact('contests'));
    }

    public function summerizeScore()
    {
        return view('soal.summerize-score.index');
    }

    public function getJenisContest(Request $request)
    {
        $jenis_contest = $request['jenis_contest'];
        $data_contest = null;

        if ($jenis_contest == "mc") $data_contest = McContests::all();
        else if ($jenis_contest == "essay") $data_contest = EssayContests::all();
        else if ($jenis_contest == "prg") $data_contest = PrgContests::all();

        return response()->json(array(
            'msg' => $data_contest
        ), 200);
    }

    public function getTotalScore(Request $request)
    {
        $jenis_contest = $request['jenis_contest'];
        $id_contest = $request['id_contest'];

        if ($jenis_contest == "mc") {
            $data = Team::McScoreboard($id_contest);
        } else if ($jenis_contest == "essay") {
            $data = Team::EssayScoreboard($id_contest);
        } else if ($jenis_contest == "prg") {
            $data = Team::PrgScoreboard($id_contest);
        }


        return response()->json(array(
            'data' => $data,
        ), 200);
    }

    public function runCode()
    {
        return view('soal.run-code.index');
    }

    public function executeCode(Request $request)
    {
        $bahasa = $request['bahasa'];
        if ($bahasa == "cpp") $ext = ".cpp";
        else if ($bahasa == "java") $ext = ".java";
        else if ($bahasa == "pascal") $ext = ".pas";
        else if ($bahasa == "python") $ext = ".py";

        $file = $request->file("input_file");
        $filename_in =  time() . "_" . '.in';
        $file->storeAs('public/prg/runcode/', $filename_in, ['disks' => 'public']);

        $file = $request->file("output_file");
        $filename_out =  time() . "_" . '.out';
        $file->storeAs('public/prg/runcode/', $filename_out, ['disks' => 'public']);

        $file = $request->file("program_file");
        $filename_program =  time() . "_" . $ext;
        $file->storeAs('public/prg/runcode/', $filename_program, ['disks' => 'public']);

        $inputSoal = public_path() . '/storage/prg/runcode/' . $filename_in;
        $outputSoal = public_path() . '/storage/prg/runcode/' . $filename_out;
        $programSoal = public_path() . '/storage/prg/runcode/' . $filename_program;
        $tempPath = public_path() . '/storage/prg/runcode';

        // Ubah format dos2unix just in case
        shell_exec("dos2unix $inputSoal");
        shell_exec("dos2unix $outputSoal");

        // If Windows (TEMP)
        // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        //     $inputSoal = str_replace('/', '\\', $inputSoal);
        //     $outputSoal = str_replace('/', '\\', $outputSoal);
        //     $programSoal = str_replace('/', '\\', $programSoal);
        //     $tempPath = str_replace('/', '\\', $tempPath);
        // }

        echo "$inputSoal <br>";
        echo "$outputSoal <br>";
        echo "$programSoal <br>";
        echo "$tempPath <br>";

        $result = "Accepted";
        $runtime = 0;
        
        // Command1 for compiling
        // Command2 for timing and result
        if ($bahasa == "cpp") {
            $command1 = "clang++ $programSoal -o $tempPath/compiled_cpp";
            $command2 = "time $tempPath/compiled_cpp <$inputSoal> $tempPath/result.out";
        } else if ($bahasa == "java") {
            $command1 = "javac $programSoal -d $tempPath";
            $command2 = "time java -cp $tempPath Main <$inputSoal> $tempPath/result.out";
        } else if ($bahasa == "pascal") {
            $command1 = "fpc $programSoal -o'$tempPath/compiled_pascal'";
            $command2 = "time $tempPath/compiled_pascal <$inputSoal> $tempPath/result.out";
        } else if ($bahasa == "python") {
            $command1 = ""; // Python doesn't need to be compiled
            $command2 = "time python3 $programSoal < $inputSoal";
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
            $memory_limit = 64 * 1024; //64MB
            $time_limit = 30; //15second

            $process = proc_open("bash -c 'ulimit -St $time_limit -Sm $memory_limit ; $command2'", $descriptorspec, $pipes);
            if (is_resource($process)) {
                $stream = stream_get_contents($pipes[2]);
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
        }

        echo "result : " . $result . "<br />";
        echo "runtime : " . $runtime . "<br />";

        shell_exec("rm $inputSoal");
        shell_exec("rm $outputSoal");
        shell_exec("rm $programSoal");

        return back()->with('result', $result)->with('runtime', $runtime);
        // // shell_exec("del /S /Q $tempPath\*"); // Windows Remove All (Dont turn this on)

    }
}
