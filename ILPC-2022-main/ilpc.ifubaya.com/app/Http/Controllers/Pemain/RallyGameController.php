<?php

namespace App\Http\Controllers\Pemain;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Player;
use App\Models\RallyGame;
use App\Models\Wave;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RallyGameController extends Controller
{
    private function authorizeAccess(){
        //Check if shop open now   
        $shopOpen = Wave::where('jadwal_preparasi','<=',Carbon::Now())
        ->where('jadwal_mulai','>=',Carbon::Now())
        ->get();
        if($shopOpen->isEmpty()) abort(402, 'Shop is Closed');
        else return $shopOpen;
    }

    public function index(){
        $shopOpen = Wave::where('jadwal_preparasi','<=',Carbon::Now())
        ->where('jadwal_mulai','>=',Carbon::Now())
        ->get();

        //Get Summerize Poin
        $player = Auth::user()->team->player;
        $poin_rally = Auth::user()->team->rallyGames->sum('pivot.score');

        $items = Item::all();

        // Check Wave Now
        $wave = Wave::where('jadwal_mulai','<=',Carbon::Now())
                    ->where('jadwal_selesai','>=',Carbon::Now())->first();
                    
        //Check Open Shop
        $shopOpen = Wave::where('jadwal_preparasi','<=',Carbon::Now())
                    ->where('jadwal_mulai','>=',Carbon::Now())
                    ->get();
        
        //scoreboard Rally Game
        $data_team = RallyGame::leftJoin('rg_score', function ($join) {
            $join->on('rg_score.rally_game_id', '=', 'rally_games.id')
                ->where('rg_score.team_id', "=", Auth::user()->team->id);
        })
            ->leftJoin('teams', 'teams.id', '=', 'rg_score.team_id')
            ->get();
        
            $selected_weapon = null;
            $isUsingWeapon = $player->items->where('pivot.selected', '=', 'yes')->count();
            if ($isUsingWeapon > 0) $selected_weapon = $player->items->where('pivot.selected', '=', 'yes')->first();
        
        return view("pemain.rally-games.index", compact('data_team','wave', 'items', 'shopOpen','player','poin_rally', 'selected_weapon'));
    }

    public function shop()
    {
        $shopOpen = $this->authorizeAccess();
        // Get Player
        $player = Auth::user()->team->player;
        // Get Player weapon
        $player_weapons = $player->items->where('type','=','weapon')->where('pivot.current_durability','>','0');
        // Get Player potion
        $player_potions = $player->items->where('type','=','potion')->where('pivot.current_durability','>','0');
        // Get Player Attributtes
        $player_attributes = $player->items->where('type','=','attribute');

        // Assign Player Attributtes ID to Array for Where not in 
        $player_attributes_id = array();
        foreach ($player_attributes as $id){
            array_push($player_attributes_id, $id->id);
        }

        // Get Items tanpa attributes yang sudah dibeli player
        $items = Item::whereNotIn('id', $player_attributes_id)->get();
        
        $selected_weapon = null;
        // Check apakah player menggunakan weapon?
        $isUsingWeapon = $player->items->where('pivot.selected', '=', 'yes')->count();
        // Apabila player menggunakan weapon
        if ($isUsingWeapon > 0){
            // Set weapon yang dipakai oleh player
            $selected_weapon = $player->items->where('pivot.selected', '=', 'yes')->first();
        }
        
        return view("pemain.rally-games.shop", compact('shopOpen', 'items', 'player','player_weapons','player_potions','player_attributes', 'selected_weapon'));
    }

    public function buy(Item $item)
    {
        // Check apakah shop buka atau tidak
        $this->authorizeAccess();

        // Player
        $player = Auth::user()->team->player;

        //Check apakah uangnya cukup
        if ($player->current_money < $item->price){
            return back()->with('error', 'Cash anda tidak mencukupi untuk membeli item ini!');
        }
        // Apabila uangnya cukup
        else{
            // Check tipe item (Weapon|Potion|Attribute|Shield)
            $item_type = $item->type;
            $item_current_durability = 0;

            // Check apakah dia sudah pernah beli item yang sedang dibeli atau tidak
            $item_count = $player->items()->where('item_id', $item->id)->count();

            // Kalau player sudah punya item yang sedang dibeli
            if ($item_count > 0) {
                if ($item_type == "attribute"){
                    return back()->with('error', 'Anda sudah memiliki attribute ini!');
                }
                else{
                    $player_item = $player->items()->find($item->id);
                    // Ambil current durability dari item yang sedang dibeli
                    $item_current_durability = $player_item->pivot->current_durability;
                }
            } 

            // Kalau item weapon atau potion
            if ($item_type == "weapon"){
                // Tambahkan item ke player
                $player->items()->sync([
                    $item->id => [
                        // Tambahkan durability item
                        'current_durability' => $item_current_durability + $item->durability,
                    ]
                ],false);

                // Kurangi uang player dengan harga item
                $player->current_money = $player->current_money - $item->price;
                $player->save();

                return back()->with('success', 'Weapon berhasil dibeli');
            }
            else if ($item_type == "potion"){
                // Tambah current health player
                $health_after_healing = $player->current_health + $item->heal;
                // Check kalau healing melebihi max health, sisa heal akan terbuang 
                if ($health_after_healing >= $player->max_health){
                    $health_after_healing = $player->max_health;
                }
                // Update current health
                $player->current_health = $health_after_healing;
                // Kurangi uang player dengan harga item
                $player->current_money = $player->current_money - $item->price;
                $player->save();

                return back()->with('success', $item_type.' berhasil dipakai');
            }
            else if ($item_type == "shield"){
                // Check apakah shield sudah ada atau belum
                if(is_numeric($player->have_shield)){
                    if ($player->have_shield < 5){ // Apakah jumlah shieldnya dibawah 5
                        $player->have_shield = $player->have_shield + $item->durability;
                        // Kurangi uang player dengan harga item
                        $player->current_money = $player->current_money - $item->price;
                        $player->save();

                        return back()->with('success', 'Shield berhasil ditambahkan');
                    }
                    else{ // Shield player sudah 5
                        return back()->with('error', 'Shield anda sudah mencapai batas maximum!');
                    }
                }
                // Kalau dia belum punya shield
                else{
                    // Shield diberikan kepada player
                    $player->have_shield = $item->durability;
                    // Kurangi uang player dengan harga item
                    $player->current_money = $player->current_money - $item->price;
                    $player->save();

                    return back()->with('success', 'Shield berhasil dibeli');
                }
            }
            else if ($item_type == "attribute"){
                // Kalau attribute ada nilai heal, maka max health player ditambah
                if (isset($item->heal)){
                    // Tambahkan item ke player
                    $player->items()->sync([
                        $item->id => [
                            // Tambahkan durability item
                            'current_durability' => -1,
                        ]
                    ],false);

                    $player->max_health = $player->max_health + $item->heal;
                    $player->save();
                }

                // Kalau attribute ada nilai attack, maka max attack player ditambah
                if (isset($item->attack)){
                    $player->items()->sync([
                        $item->id => [
                            // Tambahkan durability item
                            'current_durability' => -1,
                        ]
                    ],false);

                    $player->max_attack = $player->max_attack + $item->attack;
                    $player->save();
                }
                // Kurangi uang player dengan harga item
                $player->current_money = $player->current_money - $item->price;
                $player->save();

                return back()->with('success', 'Attribute berhasil dibeli');
            }
        }

    }

    public function change_equipment(Request $request)
    {
        $this->authorizeAccess();

        // Player
        $player = Auth::user()->team->player;
        
        $item_count = $player->items->where('pivot.selected', '=', 'yes')->count();
        
        // Kalau dia ada select weapon sebelumnya 
        if ($item_count > 0){
            // Ambil selected weapon
            $selected_weapon = $player->items->where('pivot.selected', '=', 'yes')->first();

            $player->items()->sync([
                    $selected_weapon->id => [
                        // Ubah selected pada selected weapon sebelumnya menjadi no
                        'selected' => 'no',
                    ]
            ],false);
        }

        if ($request['weapon_id'] == 'no'){
            return back()->with('success', 'Selected weapon berhasil diubah');
        }
        else{
            $item = Item::find($request['weapon_id']);
            if(!isset($item)) return back()->with('error', 'Weapon yang dipilih tidak valid');

            // Check if the user have that item
            $player_weapons = $player->items->where('type','=','weapon')->where('pivot.current_durability','>','0')->where('pivot.item_id', '=', $item->id)->count();
            if($player_weapons <= 0) return back()->with('error', 'Caught cheating, poin -5');
            
            $player->items()->sync([
                    $item->id => [
                        // Ubah selected pada weapon yang di select menjadi yes
                        'selected' => 'yes',
                    ]
            ],false);

            return back()->with('success', 'Selected weapon berhasil diubah');
        }
    }
}
