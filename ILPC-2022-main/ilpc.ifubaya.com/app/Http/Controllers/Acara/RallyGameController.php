<?php

namespace App\Http\Controllers\Acara;


use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\RallyGame;
use App\Models\Team;
use Illuminate\Http\Request;
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
        $rally_games = RallyGame::paginate(12);
        return view('acara.rally-games.index', compact('rally_games'));
    }

    public function search(Request $request)
    {
        $keyword =$request['keyword'];
        $rally_games = RallyGame::where("name","LIKE","%$keyword%")->paginate(12);
        session()->flash("keyword", $keyword);
        return view('acara.rally-games.index', compact('rally_games'));
    }

    public function scoreboard()
    {
        //Get sum score rally dan gambes per tim
        $scoreboards = Player::select("teams.nama",
                        DB::raw("IFNULL(SUM(rgs.score),0)  AS 'poin_rally'"),
                        "players.poin_gambes")
                        ->join("teams","players.team_id","=","teams.id")
                        ->leftJoin("rg_score as rgs","rgs.team_id","=","teams.id")
                        ->groupBy("teams.id")
                        ->get();
        
        $index = 0;
        foreach ($scoreboards as $scoreboard) {
            //Sum total poin all :0. poin rally + 0.6 poin gambes
            $total_poin = round(0.4*$scoreboard->poin_rally + 0.6*$scoreboard->poin_gambes, 2);
            
            $scoreboards[$index]->total_poin = $total_poin;
            $index++;
        }

        $scoreboards = $scoreboards->toArray();
        // dd($scoreboards->total_poin);
        // Sorting Ranking pemain berdasarkan total poin all
        array_multisort(
            array_column($scoreboards, 'total_poin'),SORT_DESC,
            $scoreboards);//return value variable

        // $scoreboards = $scoreboards->get();
        // dd($scoreboards[0]['nama']);
        return view('acara.rally-games.scoreboard', compact('scoreboards'));
    }

    public function store(Request $request)
    {
        RallyGame::create(
            [
                'name' => $request["name"],
            ],
        );

        session()->flash('success', 'New Rally Game Succesfully Created');
        return redirect()->to(route('acara.rg.index'));
    }

    public function destroy(RallyGame $rallyGame)
    {
        $affected = $rallyGame->delete();
        $affected>0?session()->flash('success', "Rally Game ID $rallyGame->id successfully deleted"):session()->flash('success', "Rally Game ID $rallyGame->id delete failed");
        return redirect()->to(route('acara.rg.index'));
    }

    
}
