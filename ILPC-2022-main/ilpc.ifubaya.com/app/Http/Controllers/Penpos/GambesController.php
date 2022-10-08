<?php

namespace App\Http\Controllers\Penpos;

use App\Events\UpdateMap;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\Team;
use App\Models\Territory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GambesController extends Controller
{
    public function index()
    {
        $territories = Territory::all();
        $players = Player::all();

        return view('penpos.gambes.index', compact('territories', 'players'));
    }

    public function getMap()
    {
        $territories = Territory::with('players')->with('robot')->get();
        return response()->json(array(
            'territories' => $territories,
        ), 200);
    }

    public function setSpawnPoint(Request $request)
    {
        // Ambil variabel awal yang dibutuhkan
        $player = Player::find($request['player_id']);
        $territory = Territory::find($request['territory_id']);

        // Status dan message yang diberikan
        $response = '';
        $status = '';
        $msg = '';

        // Kalau penpos sudah select player
        if (isset($player)) {
            // Kalau player memang belum berada pada suatu territory (Territory idnya null)
            if (!isset($player->territory_id)) {
                // Kalau territory yang dipilih adalah territory valid
                if (isset($territory)) {
                    // Territory yang dipilih adalah daerah spawn
                    if ($territory->is_spawnable == 'yes') {
                        // Update territory player ke territory spawn point
                        $player->territory_id = $territory->id;
                        $player->poin_gambes = $player->poin_gambes - 100 <= 0 ? 0 :  $player->poin_gambes - 100;
                        $player->save();

                        // Update num occupants pada territory
                        $territory->num_occupants = $territory->num_occupants + 1;
                        $territory->save();

                        $status = 'success';
                        $response = 'success';
                        $msg = 'Berhasil melakukan spawn pada daerah yang dipilih';
                    }
                    // Territory yang dipilih bukan daerah spawn
                    else {
                        $status = 'error';
                        $response = 'error';
                        $msg = 'Territory yang dipilih bukan daerah spawn!';
                    }
                }
                // Territory yang dipilih tidak valid
                else {
                    $status = 'error';
                    $response = 'error';
                    $msg = 'Territory tidak valid!';
                }
            }
            // Player sudah berada pada suatu territory
            else {
                $status = 'error';
                $response = 'error';
                $msg = 'Player sudah berada pada suatu territory!';
            }
        }
        // Penpos belum select player
        else {
            $status = 'error';
            $response = 'error';
            $msg = 'Harap select player terlebih dahulu!';
        }

        if($response != 'error') event(new UpdateMap("updateMap"));
        return response()->json(array(
            'response' => $response,
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    public function move(Request $request)
    {
        // Ambil variabel awal yang dibutuhkan
        $player = Player::find($request['player_id']);
        $arah = $request['arah'];
        $lebar_map = 20;

        // Status dan message yang diberikan
        $status = '';
        $msg = '';
        $response = 'success';

        // Kalau penpos sudah select player
        if (isset($player)) {
            // Kalau dia sudah di map  
            if (isset($player->territory_id)) {
                // Pengecekan apakah langkah masih ada
                $sisa_move = $request['sisa_move'];
                if ($sisa_move < 1) {
                    $response = 'error';
                    $status = 'error';
                    $msg = 'Sisa langkah telah habis!';
                } else {
                    // Posisi lama pemain
                    $t_id = $player->territory_id;

                    // Territory Lama
                    $old_territory = Territory::find($t_id);

                    // Menentukan Posisi
                    if ($arah == 'atas') $t_id -= $lebar_map;
                    else if ($arah == 'kanan_atas') $t_id -= ($lebar_map + 1);
                    else if ($arah == 'kiri_atas')  $t_id -= ($lebar_map - 1);
                    else if ($arah == 'kanan') $t_id += 1;
                    else if ($arah == 'kiri') $t_id -= 1;
                    else if ($arah == 'bawah') $t_id += $lebar_map;
                    else if ($arah == 'kanan_bawah') $t_id += ($lebar_map + 1);
                    else if ($arah == 'kiri_bawah') $t_id += ($lebar_map - 1);

                    // Ambil territory
                    $new_territory = Territory::find($t_id);
                    // Territory baru adalah territory valid
                    if (isset($new_territory)) {
                        // Pengecekan Posisi Apakah Ada 2 orang
                        if ($new_territory->num_occupants >= 2) {
                            $status = 'error';
                            $response = 'error';
                            $msg = 'Territory yang hendak anda tempati sudah ditempati dua orang!';
                        }
                        // Pengecekan apakah territory adalah wall?
                        else if ($new_territory->is_wall == 'yes') {
                            $status = 'error';
                            $response = 'error';
                            $msg = 'Tidak dapat melewati wall!';
                        }
                        // Territory aman
                        else {
                            // Update Posisi ke database
                            $player->territory_id = $t_id;
                            $player->save();

                            // Update num occupant di territory lama
                            $old_territory->num_occupants = $old_territory->num_occupants - 1;
                            $old_territory->save();
                            // Update num occupant di territory baru
                            $new_territory->num_occupants = $new_territory->num_occupants + 1;
                            $new_territory->save();

                            $status = '';
                            $msg = '';
                        }
                    }
                    // Territory baru tidak valid
                    else {
                        $status = 'error';
                        $response = 'error';
                        $msg = 'Territory tidak valid!';
                    }
                }
            }
            // Player belum select spawn point
            else {
                $status = 'error';
                $response = 'error';
                $msg = 'Harap pilih Spawn Point terlebih dahulu!';
            }
        }
        // Penpos belum select player
        else {
            $status = 'error';
            $response = 'error';
            $msg = 'Harap select player terlebih dahulu!';
        }

        if($response != 'error') event(new UpdateMap("updateMap"));
        return response()->json(array(
            'response' => $response,
            'status' => $status,
            'msg' => $msg,
        ), 200);
    }

    public function action(Request $request)
    {
        // Status dan message yang diberikan
        $status = '';
        $msg = '';
        $status2 = '';
        $msg2 = '';

        $sisa_move = $request['sisa_move'];
        if ($sisa_move < 1) {
            return response()->json(array(
                'response' => 'error',
                'status' => 'error',
                'msg' => 'Sisa langkah telah habis!',
                'status2' => $status2,
                'msg2' => $msg2,
            ), 200);
        }

        // Kalau penpos belum select player
        if ($request['player_id'] == null) {
            return response()->json(array(
                'response' => 'error',
                'status' => 'error',
                'msg' => 'Harap select player terlebih dahulu!',
                'status2' => $status2,
                'msg2' => $msg2,
            ), 200);
        }

        // Set Variabel awal
        $player = Player::find($request['player_id']);
        $territory = $player->territory;
        $player_total_attack = $player->max_attack;
        $robotIsDead = false;
        $player2IsDead = false;


        // Melakukan action bukan pada daerah spawn
        if ($territory->is_spawnable == 'yes') {
            return response()->json(array(
                'response' => 'error',
                'status' => 'error',
                'msg' => 'Tidak dapat melakukan action pada daerah spawn!',
                'status2' => $status2,
                'msg2' => $msg2,
            ), 200);
        }

        // Check apakah player menggunakan weapon?
        $isUsingWeapon = $player->items->where('pivot.selected', '=', 'yes')->count();
        // Apabila player menggunakan weapon
        if ($isUsingWeapon > 0) {
            // Set weapon yang dipakai oleh player
            $selected_weapon = $player->items->where('pivot.selected', '=', 'yes')->first();
            // Ambil durability sebelum attack
            $durability_before_attack = $selected_weapon->pivot->current_durability;
            // Player total attack = Max Attack + Attack Weapon yang digunakan
            $player_total_attack = $player->max_attack + $selected_weapon->attack;
        }

        // Pengecekan apakah num occupant territory yang di temmpati adalah 2?
        if ($territory->num_occupants == 2) {
            // Kalau occupant ke dua adalah robot
            if (isset($territory->robot_id)) {
                // Set robot
                $robot = $territory->robot;
                // Status robot
                $robot_attack = $robot->attack;
                $robot_health = $robot->health;

                // Check current health robot sudah dibawah 0 atau belum
                if ($territory->current_health >= 0) {
                    // Kalau player ada shield
                    if (is_numeric($player->have_shield)) {
                        $status = 'success';
                        $msg = 'Shield berhasil terpakai';
                        $player->have_shield = $player->have_shield - 1 <= 0 ? 'no' :  $player->have_shield - 1;
                        $player->save();
                    } else { // Tidak ada shield
                        // Robot attack duluan
                        $player->current_health = $player->current_health - $robot_attack;
                        $player->save();

                        if ($player->current_health <= 0) { // Kalau player mati
                            $territory->num_occupants = $territory->num_occupants - 1;
                            $territory->save();

                            // Posisinya set null supaya dia bisa pilih mau respawn dimana
                            $player->territory_id = NULL;
                            // Isi ulang darahnya sampai full
                            $player->current_health = $player->max_health;
                            $player->save();

                            $robotIsDead = true;

                            $status = 'error';
                            $msg = 'Player telah terbunuh oleh robot! Kembali ke respawn';
                        }
                    }

                    // Kalau dia masih bertahan hidup dari serangan robot atau menggunakan shield
                    if ($player->current_health > 0 && !$robotIsDead) {
                        // Kurangi health robot
                        $robot_health_after_attacked = $territory->current_health - $player_total_attack;
                        // Kalau health berkurang sampai lebih dari 0
                        if ($robot_health_after_attacked < 0) {
                            $robot_health_after_attacked = 0;
                        }
                        // Update robot health 
                        $territory->current_health = $robot_health_after_attacked;
                        $territory->save();

                        // Kalau player menggunakan weapon
                        if ($isUsingWeapon > 0) {
                            // Kurangi durability -1
                            $current_durability = $durability_before_attack - 1;
                            // Kalau durability habis, maka weapon di delete dari inventory
                            if ($current_durability <= 0) {
                                $player->items()->detach($selected_weapon->id);
                            }
                            // Kalau durability belum habis, update ke db current durability -1
                            else {
                                $player->items()->sync([$selected_weapon->id => ['current_durability' => $durability_before_attack - 1]], false);
                            }
                        }

                        $status2 = 'success';
                        $msg2 = 'Attack berhasil! Health robot berkurang ' . $player_total_attack;

                        // Kalau robot mati
                        if ($territory->current_health <= 0) {
                            // Set Territory jadi territory normal tanpa robot
                            $territory->robot_id = NULL;
                            $territory->current_health = NULL;
                            $territory->num_occupants = $territory->num_occupants - 1;
                            $territory->save();

                            // Update poin gambes yang didapatkan player
                            $poin_gambes = $robot_health;
                            $player->poin_gambes = $player->poin_gambes + $poin_gambes;
                            $player->save();

                            $status2 = 'success';
                            $msg2 = 'Robot berhasil dibunuh! Anda mendapatkan ' . $poin_gambes . ' Poin';
                        }
                    }
                }
            }
            // Kalau occupant ke dua adalah player lain
            else {
                // Set player lain
                $player_2 = Player::where('territory_id', '=', $territory->id)
                    ->where('id', '!=', $player->id)
                    ->first();
                $player_2_total_attack = $player_2->max_attack;
                // == Player 1 Attacking ==
                if ($player->current_health > 0) { // Kalau player yang nyerang masih bernyawa
                    if (is_numeric($player_2->have_shield)) { // Kalau player 2 ada shield
                        $player_2->have_shield = $player_2->have_shield - 1 <= 0 ? 'no' : $player_2->have_shield - 1;
                        $player_2->save();

                        if ($isUsingWeapon > 0) { // Kalau player menggunakan weapon
                            $current_durability = $durability_before_attack - 1; // Kurangi durability -1
                            if ($current_durability <= 0) $player->items()->detach($selected_weapon->id); // Kalau durability habis, maka weapon di delete dari inventory
                            else $player->items()->sync([$selected_weapon->id => ['current_durability' => $durability_before_attack - 1]], false); // Kalau durability belum habis, update ke db current durability -1
                        }

                        $status = 'error';
                        $msg = 'Gagal melakukan penyerangan! Player ' . $player_2->team->nama . ' menggunakan shield!';
                    } else { // Kalau player 2 tidak ada shield
                        // Player attack player lain
                        $player_2_health_after_attacked = $player_2->current_health - $player_total_attack; // Kurangi health dari player lain

                        if ($isUsingWeapon > 0) { // Kalau player menggunakan weapon
                            $current_durability = $durability_before_attack - 1; // Kurangi durability -1
                            if ($current_durability <= 0) $player->items()->detach($selected_weapon->id); // Kalau durability habis, maka weapon di delete dari inventory
                            else $player->items()->sync([$selected_weapon->id => ['current_durability' => $durability_before_attack - 1]], false); // Kalau durability belum habis, update ke db current durability -1
                        }

                        // Player 2 Killed
                        if ($player_2_health_after_attacked <= 0) {
                            $player2IsDead = true; // Set player 2 mati

                            // Tambah poin gambes ke attacker yang berhasil membunuh player lain sebesar 20% dari poin gambes
                            $poin_gambes = round($player_2->poin_gambes * 0.2, 2);
                            // Penambahan poin player yang berhasil membunuh
                            $player->poin_gambes = $player->poin_gambes + $poin_gambes;
                            $player->current_money = $player->current_money + 150; // Dapet uang 150
                            $player->save();
                            // Kurangi num occupant di territory karena playernya sudah mati
                            $territory->num_occupants = $territory->num_occupants - 1;
                            $territory->save();
                            // Pengurangan poin player yang mati & Reset health player yang terbunuh & Set territory_id player yang sudah mati menjadi null
                            $player_2->poin_gambes = $player_2->poin_gambes - $poin_gambes;
                            $player_2->current_health = $player_2->max_health;
                            $player_2->territory_id = null;
                            $player_2->save();

                            $status = 'success';
                            $msg = 'Player ' . $player_2->team->nama . ' berhasil dibunuh! Anda merebut ' . $poin_gambes . ' poin';
                        } else { // Player 2 Alive
                            // Kurangi health player 2
                            $player_2->current_health = $player_2_health_after_attacked;
                            $player_2->save();

                            $status = 'success';
                            $msg = 'Serangan terhadap Player ' . $player_2->team->nama . ' berhasil dilakukan!';
                        }
                    }
                }

                // If Already Dead then Return
                if ($player2IsDead) {
                    event(new UpdateMap("updateMap"));
                    return response()->json(array(
                        'response' => 'success',
                        'status' => $status,
                        'msg' => $msg,
                        'status2' => $status2,
                        'msg2' => $msg2,
                    ), 200);
                }

                // Check apakah player 2 menggunakan weapon?
                $isUsingWeapon_2 = $player_2->items->where('pivot.selected', '=', 'yes')->count();
                // Apabila player menggunakan weapon
                if ($isUsingWeapon_2 > 0) {
                    // Set weapon yang dipakai oleh player
                    $selected_weapon_2 = $player_2->items->where('pivot.selected', '=', 'yes')->first();
                    // Ambil durability sebelum attack
                    $durability_before_attack_2 = $selected_weapon_2->pivot->current_durability;
                    // Player total attack = Max Attack + Attack Weapon yang digunakan
                    $player_2_total_attack = $player_2->max_attack + $selected_weapon_2->attack;
                }

                // == Player 2 Attacking ==
                if ($player_2->current_health > 0) { // Kalau player yang nyerang masih bernyawa
                    if (is_numeric($player->have_shield)) { // Kalau player 1 ada shield
                        $player->have_shield = $player->have_shield - 1 <= 0 ? 'no' : $player->have_shield - 1;
                        $player->save();

                        if ($isUsingWeapon_2 > 0) { // Kalau player 2 menggunakan weapon
                            $current_durability_2 = $durability_before_attack_2 - 1; // Kurangi durability -1
                            if ($current_durability_2 <= 0) $player_2->items()->detach($selected_weapon_2->id); // Kalau durability habis, maka weapon di delete dari inventory
                            else $player_2->items()->sync([$selected_weapon_2->id => ['current_durability' => $durability_before_attack_2 - 1]], false); // Kalau durability belum habis, update ke db current durability -1
                        }

                        $status2 = 'success';
                        $msg2 = 'Shield anda terpakai akibat musuh menyerang balik!';
                    } else { // Kalau player 1 tidak ada shield
                        // Player 2 attack player 1
                        $player_health_after_attacked = $player->current_health - $player_2_total_attack; // Kurangi health dari player lain

                        if ($isUsingWeapon_2 > 0) { // Kalau player menggunakan weapon
                            $current_durability_2 = $durability_before_attack_2 - 1; // Kurangi durability -1
                            if ($current_durability_2 <= 0) $player_2->items()->detach($selected_weapon_2->id); // Kalau durability habis, maka weapon di delete dari inventory
                            else $player_2->items()->sync([$selected_weapon_2->id => ['current_durability' => $durability_before_attack_2 - 1]], false); // Kalau durability belum habis, update ke db current durability -1
                        }

                        // Player 1 Killed
                        if ($player_health_after_attacked <= 0) {
                            // Tambah poin gambes ke attacker yang berhasil membunuh player lain sebesar 20% dari poin gambes
                            $poin_gambes_2 = round($player->poin_gambes * 0.2, 2);
                            // Penambahan poin player yang berhasil membunuh
                            $player_2->poin_gambes = $player_2->poin_gambes + $poin_gambes_2;
                            $player_2->current_money = $player_2->current_money + 150; // Dapet uang 150
                            $player_2->save();            
                            // Kurangi num occupant di territory karena playernya sudah mati
                            $territory->num_occupants = $territory->num_occupants - 1;
                            $territory->save();
                            // Pengurangan poin player yang mati & Reset health player yang terbunuh & Set territory_id player yang sudah mati menjadi null
                            $player->poin_gambes = $player->poin_gambes - $poin_gambes_2;
                            $player->current_health = $player->max_health;
                            $player->territory_id = null;
                            $player->save();

                            $status2 = 'error';
                            $msg2 = 'Anda terbunuh! ' . $player_2->team->nama . ' berhasil merebut ' . $poin_gambes_2 . ' poin';
                        }
                        else { // Player Alive
                            // Kurangi health player
                            $player->current_health = $player_health_after_attacked;
                            $player->save();

                            $status2 = 'error';
                            $msg2 = 'Player ' . $player_2->team->nama . ' menyerang balik!';
                        }
                    }
                }
                event(new UpdateMap("updateMap"));
                return response()->json(array(
                    'response' => 'success',
                    'status' => $status,
                    'msg' => $msg,
                    'status2' => $status2,
                    'msg2' => $msg2,
                ), 200);
            } // Pengecekan Robot or Player
        } // Pengecekan 2 Occupants

        event(new UpdateMap("updateMap"));
        return response()->json(array(
            'response' => 'success',
            'status' => $status,
            'msg' => $msg,
            'status2' => $status2,
            'msg2' => $msg2,
        ), 200);
    }
}
