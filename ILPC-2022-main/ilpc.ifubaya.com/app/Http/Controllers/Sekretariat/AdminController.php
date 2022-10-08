<?php

namespace App\Http\Controllers\Sekretariat;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Competition;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::orderBy('id', 'desc')->paginate(12);
        $competitions = Competition::orderBy('id', 'desc')->get();
        return view('sekretariat.admins.index', compact('admins', 'competitions'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'role' => ['required'],
            'username' => ['required'],
            'password' => ['required', 'confirmed'],
            'nama' => ['required'],
            'nrp_npk' => ['required'],
            'competition_id' => ['required'],
        ]);

        $user = new User;
        $user->role = $request["role"];
        $user->username = $request["username"];
        $user->password = Hash::make($request["password"]);
        $user->save();

        $admin = new Admin;
        $admin->nama = $request["nama"];
        $admin->nrp_npk = $request["nrp_npk"];
        $admin->status = "ready";
        $admin->competition_id = $request["competition_id"];

        $user->admin()->save($admin);

        session()->flash('success', 'New Admin Succesfully Created');
        return redirect()->to(route('sekretariat.admins.index'));
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'password' => ['required', 'confirmed'],
        ]);

        $admin->user->password = Hash::make($request["password"]);
        $admin->user->save();

        session()->flash("success", "Admin $admin->id password successfully updated");
        return redirect()->to(route('sekretariat.admins.index'));
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        session()->flash('success', "Admin ID $admin->id successfully deleted");
        return redirect()->to(route('sekretariat.admins.index'));
    }
}
