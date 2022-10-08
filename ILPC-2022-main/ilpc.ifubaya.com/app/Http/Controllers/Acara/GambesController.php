<?php

namespace App\Http\Controllers\Acara;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Wave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GambesController extends Controller
{
    public function index_wave()
    {
        $waves = Wave::all();
        return view('acara.gambes.wave.index', compact('waves'));
    }

    public function index_item()
    {
        $items = Item::all();
        return view('acara.gambes.item.index', compact('items'));
    }

    public function store_wave(Request $request){
        Wave::create(
            [
                'nomor' => $request["nomor"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'jadwal_preparasi' => $request["jadwal_preparasi"],
            ],
        );

        session()->flash('success', 'New Wave Succesfully Created');
        return redirect()->to(route('acara.gambes.wave.index'));
    }

    public function update_wave(Wave $wave, Request $request){
        $wave->update(
            [
                'nomor' => $request["nomor"],
                'jadwal_mulai' => $request["jadwal_mulai"],
                'jadwal_selesai' => $request["jadwal_selesai"],
                'jadwal_preparasi' => $request["jadwal_preparasi"],
            ],
        );

        session()->flash("success", "Wave with Id $wave->id successfully updated");
        return redirect()->to(route('acara.gambes.wave.index'));
    }

    public function destroy_wave(Wave $wave){
        $affected = $wave->delete();
        $affected>0?session()->flash('success', "Wave with ID $wave->id successfully deleted"):session()->flash('error', "Wave with ID $wave->id delete failed");
        return redirect()->to(route('acara.gambes.wave.index'));
    }


    // Item
    public function store_item(Request $request){
        $item = new Item();
        $item->type = $request["type"];
        $item->name = $request["name"];
        $item->price = $request["price"];
        $item->heal = $request["heal"];
        $item->attack = $request["attack"];
        $item->durability = $request["durability"];
        $item->save();

        $file = $request->file('file');
        $file->storeAs('public/foto/gamebes/item/', $item->name."_".$item->id . '.png', ['disks' => 'public']);
        $item->image_path = 'storage/foto/gamebes/item/' . $item->name."_".$item->id . '.png';
        $item->save();

        session()->flash('success', 'New Item Succesfully Created');
        return redirect()->to(route('acara.gambes.item.index'));
    } 

    public function update_item(Item $item, Request $request){
        $item->type = $request["type"];
        $item->name = $request["name"];
        $item->price = $request["price"];
        $item->heal = $request["heal"];
        $item->attack = $request["attack"];
        $item->durability = $request["durability"];
        if (request()->hasFile('file')) {
            File::delete($item->image_path);
            $file = request()->file($request['file']);
            $file->storeAs('public/foto/gamebes/item/', $item->name."_".$item->id . '.png', ['disks' => 'public']);
            $item->image_path = 'storage/foto/gamebes/item/' . $item->name."_".$item->id . '.png';
        }
        $item->save();

        session()->flash("success", "Item with Id $item->id successfully updated");
        return redirect()->to(route('acara.gambes.item.index'));
    }

    public function destroy_item(Item $item){
        $affected = $item->delete();
        $affected>0?session()->flash('success', "Item with ID $item->id successfully deleted"):session()->flash('error', "Item with ID $item->id delete failed");
        return redirect()->to(route('acara.gambes.wave.index'));
    }
    // End of Item
}
