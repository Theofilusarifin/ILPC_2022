<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParticipantRequest;
use App\Models\Participant;

class ParticipantController extends Controller
{


    public function setMode(){
        // If dark, set to light, else set to dark\
        $change_mode = request()->session()->get('mode') == 'dark' ? 'light' : 'dark';
        request()->session()->put('mode', $change_mode);
        return response()->json(array(
            'msg' => "Mode $change_mode",
        ), 200);;
    }

    public function index()
    {
        $list_Participants = Participant::all();

        return view('participants.index', compact('list_Participants'));
    }




    public function create()
    {
        return view('participants.create');
    }




    public function store(ParticipantRequest $request)
    {
        $attr = $request->all();
        Participant::create($attr);
        session()->flash('success', 'Participant Registration Success');
        return redirect('/');
    }




    public function show(Participant $participant)
    {
        return view('participants.show', compact('participant'));
    }




    public function edit(Participant $participant)
    {
        return view('participants.edit', compact('participant'));
    }




    public function update(ParticipantRequest $request, Participant $participant)
    {
        $attr = $request->all();
        $participant->update($attr);
        session()->flash('success', "Team Update Success");
        return redirect('/');
    }


    

    public function destroy(Participant $participant)
    {
        $participant->delete();
        session()->flash('success', "Participant Delete Success");
        return redirect('/');
    }
}
