<?php

namespace App\Http\Controllers\Penpos;

use App\Http\Controllers\Controller;
use App\Models\RallyGame;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RallyGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Hapus ini setelah simul!
        // $teams = DB::select(DB::raw("select * from teams where id in (33,34,35,36,37,38,39,40,41,42,43,44,45,46,47)"));
        
        // Uncomment ini setelah simul!
        $teams = Team::join('players', 'players.team_id', '=', 'teams.id')->get('teams.*');
        $rally_games = RallyGame::all();

        return view('penpos.rally-games.index', compact('teams', 'rally_games'));
    }

    public function getDataTeam()
    {

        $data_team = RallyGame::leftJoin('rg_score', function ($join) {
            $join->on('rg_score.rally_game_id', '=', 'rally_games.id')
                ->where('rg_score.team_id', "=", request('team_id'));
        })
            ->leftJoin('teams', 'teams.id', '=', 'rg_score.team_id')
            ->get();

        // dd($data_team);
        return response()->json(array(
            'msg' => $data_team
        ), 200);
    }

    public function store(Request $request)
    {
        RallyGame::create(
            [
                'nama' => $request["nama"],
            ],
        );

        session()->flash('success', 'New Rally Game Succesfully Created');
        return redirect()->to(route('soal.mc.index'));
    }

    public function updateScore(Request $request)
    {
        $rallyGame = RallyGame::find($request['pos_id']);
        $team = Team::find($request['team_id']);

        $player_current_score = $rallyGame->teams->where('pivot.team_id', '=', $request['team_id'])->isEmpty() ? 0 : $rallyGame->teams->where('pivot.team_id', '=', $request['team_id'])->first()->pivot->score;
        $rallyGame->teams()->sync([$request['team_id'] => ['score' => $player_current_score + $request['score']]], false);


        // $player_current_money = $team->player->current_money;
        $team->player->current_money = $team->player->current_money + $request['score'];
        $team->player->save();
        
        $data_team = RallyGame::leftJoin('rg_score', function ($join) {
            $join->on('rg_score.rally_game_id', '=', 'rally_games.id')
                ->where('rg_score.team_id', "=", request('team_id'));
        })
            ->leftJoin('teams', 'teams.id', '=', 'rg_score.team_id')
            ->get();

        return response()->json(array(
            'msg' => $data_team
        ), 200);
    }
}
