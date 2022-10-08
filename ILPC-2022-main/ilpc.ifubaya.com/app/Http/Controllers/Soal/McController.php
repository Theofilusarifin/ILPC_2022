<?php

namespace App\Http\Controllers\Soal;

use App\Http\Controllers\Controller;
use App\Models\McChoices;
use App\Models\McContests;
use App\Models\McQuestions;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class McController extends Controller
{
    public function search_contest(Request $request)
    {
        // dd($request);
        $keyword =$request['keyword'];
        $contests = McContests::where("nama","LIKE","%$keyword%")->paginate(12);

        session()->flash("keyword", $keyword);

        return view('soal.multiple-choice.index', compact('contests'));
    }

    public function show_contest(McContests $contest)
    {
        $questions = $contest->mcQuestions()->orderBy('nomor', 'asc')->get();
        $admin = $contest->admin()->first(); //Get the first admin

        return view('soal.multiple-choice.show', compact('questions', 'contest', 'admin'));
    }

    public function create_contest()
    {
    }

    public function store_contest(Request $request)
    {
        // dd($request);
        McContests::create(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'admin_id' => auth()->user()->admin->id,
                'slug' => Str::slug(Str::lower($request["nama"]).Str::random(8) , "-"),
            ],
        );

        session()->flash('success', 'New Multiple Choice Contest Succesfully Created');
        return redirect()->to(route('soal.mc.index'));
    }

    public function edit_contest()
    {
        
    }

    public function update_contest(Request $request, McContests $contest)
    {
        // dd($request);
        $contest->update(
            [
                'nama' => $request["nama"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                // 'admin_id' =>  auth()->user()->id,
            ],
        );

        session()->flash("success", "contest $contest->id successfully updated");
        return redirect()->to(route('soal.mc.show',$contest->id));
    }

    public function destroy_contest(McContests $contest)
    {
        $contest->delete();
        session()->flash('success', "Multiple Choice Contest ID $contest->id successfully deleted");
        return redirect()->to(route('soal.mc.index'));
    }

    public function show_participant(McContests $contest)
    {
        $all_teams = Team::all()->where('status', 'ready');
        $teams = $contest->teams()->paginate(25);

        return view('soal.multiple-choice.participant.index', compact('contest', 'all_teams', 'teams'));
    }

    public function store_participant(McContests $contest, Request $request)
    {
        $team_id = $request['team_id'];
        $contest->teams()->sync($team_id, false);
        session()->flash('success', 'Participant Sucesfully Added');
        return back();
    }

    public function destroy_participant(McContests $contest, Team $team)
    {
        $deleted = $contest->teams()->detach($team->id);
        session()->flash('success', 'Participant Sucesfully Deleted');
        return back();
    }

    public function create_question(McContests $contest)
    {
        return view('soal.multiple-choice.question.create', compact('contest'));
    }

    public function store_question(McContests $contest, Request $request)
    {
        $mcQuestions = new McQuestions();
        $mcQuestions->nomor = $request['nomor'];
        $mcQuestions->isi = $request['isi'];
        $mcQuestions->jawaban_benar = $request['jawaban_benar'];
        $mcQuestions->mc_contest_id = $contest->id;
        $mcQuestions->save();

        $new_question_id = $mcQuestions->id;

        $mcChoices = new McChoices();
        $mcChoices->abjad = 'A';
        $mcChoices->isi = $request['isi_A'];
        $mcChoices->mc_question_id = $new_question_id;
        $mcChoices->save();

        $mcChoices = new McChoices();
        $mcChoices->abjad = 'B';
        $mcChoices->isi = $request['isi_B'];
        $mcChoices->mc_question_id = $new_question_id;
        $mcChoices->save();

        $mcChoices = new McChoices();
        $mcChoices->abjad = 'C';
        $mcChoices->isi = $request['isi_C'];
        $mcChoices->mc_question_id = $new_question_id;
        $mcChoices->save();

        $mcChoices = new McChoices();
        $mcChoices->abjad = 'D';
        $mcChoices->isi = $request['isi_D'];
        $mcChoices->mc_question_id = $new_question_id;
        $mcChoices->save();

        $mcChoices = new McChoices();
        $mcChoices->abjad = 'E';
        $mcChoices->isi = $request['isi_E'];
        $mcChoices->mc_question_id = $new_question_id;
        $mcChoices->save();

        session()->flash('success', 'New Question Sucesfully Created');
        return redirect()->route('soal.mc.show', $contest->id);
    }

    public function edit_question(McContests $contest, McQuestions $question){
        $choices = $question->mcChoices;

        return view('soal.multiple-choice.question.edit', compact('contest', 'question', 'choices'));
    }

    public function update_question(McContests $contest, McQuestions $question,  Request $request){
        $question->nomor = $request['nomor'];
        $question->isi = $request['isi'];
        $question->jawaban_benar = $request['jawaban_benar'];
        $question->save();

        $choices = $question->mcChoices()->orderBy('abjad', 'asc')->get();

        $choice_a = $choices[0];
        $choice_a->isi = $request['isi_A'];
        $choice_a->save();

        $choice_b = $choices[1];
        $choice_b->isi = $request['isi_B'];
        $choice_b->save();

        $choice_c = $choices[2];
        $choice_c->isi = $request['isi_C'];
        $choice_c->save();
        
        $choice_d = $choices[3];
        $choice_d->isi = $request['isi_D'];
        $choice_d->save();

        $choice_e = $choices[4];
        $choice_e->isi = $request['isi_E'];
        $choice_e->save();
        
        session()->flash('success', 'Question '. $question->nomor .' Sucesfully Edited');
        return redirect()->route('soal.mc.show', $contest->id);
    }

    public function destroy_question(McQuestions $question, Request $request)
    {
        $question = McQuestions::find($request['id']);
        $question->delete();
        session()->flash('success', 'Question Sucesfully Deleted');
        return redirect()->back();
    }
}
