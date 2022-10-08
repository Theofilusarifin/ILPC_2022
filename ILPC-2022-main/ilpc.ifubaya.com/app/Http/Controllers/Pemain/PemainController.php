<?php

namespace App\Http\Controllers\Pemain;

use App\Models\User;
use App\Models\Team;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ParticipantRequest;
use App\Http\Requests\PaymentRequest;
use App\Models\EssayContests;
use App\Models\McContests;
use App\Models\McQuestions;
use App\Models\PrgContests;
use Illuminate\Support\Carbon;

class PemainController extends Controller
{
    // public function __construct(){
    //     $this->middleware('pemain')->only('index');
    // }

    public function index()
    {
        // Define Data untuk Join
        $team = Auth::user()->team;
        $teacher =  $team->teacher;
        $school = $teacher->school;
        $participants = $team->participants;

        return view("pemain.index", compact('team', 'participants', 'teacher', 'school'));
    }

    public function upload(PaymentRequest $request)
    {

        $user = User::find(Auth::user()->id);
        // dd($user);
        $team = Auth::user()->team;
        // dd($team->nama);
        $file = $request->file("foto_upload_pembayaran");
        // dd(request());
        $file->storeAs('public/foto/' . $user->username, $team->nama . '_bukti_transfer' . '.png', ['disks' => 'public']);
        $team->bukti_transfer = 'storage/foto/' . $user->username . "/" . $team->nama . '_bukti_transfer.png';

        $team->status = "unverified";
        $team->save();

        return redirect()->back();
    }

    public function contest()
    {
        $prg_contests = PrgContests::join('team_join_prg_contest', 'team_join_prg_contest.prg_contest_id', '=', 'prg_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '<=', Carbon::now())
            ->where('jadwal_selesai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $mc_contests = McContests::join('team_join_mc_contest', 'team_join_mc_contest.mc_contest_id', '=', 'mc_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '<=', Carbon::now())
            ->where('jadwal_selesai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $essay_contests = EssayContests::join('team_join_essay_contest', 'team_join_essay_contest.essay_contest_id', '=', 'essay_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '<=', Carbon::now())
            ->where('jadwal_selesai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $active_contests = ["Programming" => $prg_contests, "Multiple Choice" => $mc_contests, "Essay" => $essay_contests];

        $prg_contests = PrgContests::join('team_join_prg_contest', 'team_join_prg_contest.prg_contest_id', '=', 'prg_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $mc_contests = McContests::join('team_join_mc_contest', 'team_join_mc_contest.mc_contest_id', '=', 'mc_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $essay_contests = EssayContests::join('team_join_essay_contest', 'team_join_essay_contest.essay_contest_id', '=', 'essay_contests.id')
            ->whereNull('waktu_selesai')
            ->where('jadwal_mulai', '>=', Carbon::now())
            ->where('team_id', '=', Auth::user()->team->id)
            ->get();
        $upcoming_contests = ["Programming" => $prg_contests, "Multiple Choice" => $mc_contests, "Essay" => $essay_contests];

        return view("pemain.contest.index", compact('active_contests', 'upcoming_contests'));
    }

    public function joinContest(Request $request)
    {
        $contest_type = $request["contest_type"];
        $contest_id = $request["contest_id"];
        $status = $request["status"];

        // Also, check if there is waktu bergabung, dont do it again incase()
        if ($contest_type == "Multiple Choice") {
            $contest = McContests::find($contest_id);
            $waktu_bergabung = $contest->teams->where('id', '=', Auth::user()->team->id)->first()->pivot->waktu_bergabung;
            if ($status == "Join" && !isset($waktu_bergabung)) Auth::user()->team->mcContests()->sync([$contest_id => ['waktu_bergabung' => Carbon::now()]], false);

            $question = $contest->mcQuestions()->orderBy('nomor', 'ASC')->first();
            return redirect(route('pemain.contest.mc', [$contest->slug, $question->nomor]));
        } else if ($contest_type == "Programming") {
            $contest = PrgContests::find($contest_id);
            $waktu_bergabung = $contest->teams->where('id', '=', Auth::user()->team->id)->first()->pivot->waktu_bergabung;
            if ($status == "Join" && !isset($waktu_bergabung)) Auth::user()->team->prgContests()->sync([$contest_id => ['waktu_bergabung' => Carbon::now()]], false);

            return redirect(route('pemain.contest.prg', [$contest->slug]));
        } else if ($contest_type == "Essay") {
            $contest = EssayContests::find($contest_id);
            $waktu_bergabung = $contest->teams->where('id', '=', Auth::user()->team->id)->first()->pivot->waktu_bergabung;
            if ($status == "Join" && !isset($waktu_bergabung)) Auth::user()->team->essayContests()->sync([$contest_id => ['waktu_bergabung' => Carbon::now()]], false);

            return redirect(route('pemain.contest.essay', [$contest->slug]));
        }
    }
}
