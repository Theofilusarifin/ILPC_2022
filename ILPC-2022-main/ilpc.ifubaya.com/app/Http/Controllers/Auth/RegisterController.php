<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\Regency;
use App\Models\School;
use App\Models\Teacher;
use App\Models\Team;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    use RegistersUsers;

    public function __construct()
    {
        abort(404);
    }

    public function showRegistrationForm()
    {
        $regencies = Regency::select('regencies.*')
            ->join('schools', "schools.regency_id", "=", "regencies.id")
            ->join('teachers', "teachers.school_id", "=", "schools.id")
            ->distinct()->get();
        return view('auth.register', compact('regencies'));
    }

    protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {
        switch (Auth::user()->role) {
            case 'sekretariat':
                $this->redirectTo = '/sekretariat';
                return $this->redirectTo;
                break;
            case 'soal':
                $this->redirectTo = '/soal';
                return $this->redirectTo;
                break;
            case 'pemain':
                $this->redirectTo = '/pemain';
                return $this->redirectTo;
                break;
            default:
                $this->redirectTo = '/login';
                return $this->redirectTo;
        }
    }

    protected function validator(array $data)
    {
        $arrStatus = ["ketua", "anggota_1", "anggota_2"];

        // If Cadangan set to yes, then validate it!
        if ($data['cadangan_status'] == "yes") array_push($arrStatus, "cadangan");
        else if ($data['cadangan_status'] == "no") { // Don't validate cadangan
        } else abort(404);

        $arrValidator = [];
        // dd($data);
        foreach ($arrStatus as $status) {
            $arrValidator[$status . "_nama"] = ['required'];
            $arrValidator[$status . "_kelas"] = ['required'];
            $arrValidator[$status . "_telp"] = ['required'];
            $arrValidator[$status . "_email"] = ['email', 'required'];
            $arrValidator[$status . "_foto_upload"] = ["required", "file", "max: 10000", "mimes:jpeg,jpg,png"];
        }
        $arrValidator["teacher_id"] =  ['required'];
        $arrValidator["team_nama"] =  ['required', 'alpha_num', 'min: 4', 'max:12'];
        $arrValidator["username"] =  ['required', 'alpha_dash', 'min: 4', 'max:8', 'unique:users'];
        $arrValidator["password"] =  ['required', 'string', 'min: 8', 'confirmed'];

        // Captcha
        $arrValidator["g-recaptcha-response"] =  ['required', 'captcha'];

        return Validator::make($data, $arrValidator);
    }

    public function getSchool()
    {
        $regency_id = request('regency_id');
        $school = School::select('schools.*')->join('teachers', "teachers.school_id", "=", "schools.id")->distinct()->where('regency_id', $regency_id)->get();
        return response()->json(array(
            'msg' => $school
        ), 200);
    }

    public function getTeacher()
    {
        $school_id = request('school_id');
        $teacher = Teacher::where('school_id', $school_id)->get();

        return response()->json(array(
            'msg' => $teacher
        ), 200);
    }

    protected function create(array $data)
    {
        // Create User
        $user = new User;
        $user->username = $data['username'];
        $user->password = Hash::make($data['password']);
        $user->role = "pemain";
        $user->email = $data['ketua_email'];
        $user->save();

        // Create Team
        $team  = new Team;
        $team->nama = $data['team_nama'];
        $team->status = 'waiting';

        $team->competition_id = 10;
        $team->teacher_id = $data['teacher_id'];

        $user->team()->save($team);

        // Penggulangan 3 kali
        $penggulangan = 3;
        // Apabila ada cadangan penggulangan 4 kali
        if ($data['cadangan_status'] == "yes") $penggulangan = 4;

        // Create Each Participant
        $arrStatus = ["ketua", "anggota_1", "anggota_2", "cadangan"];

        for ($i = 0; $i < $penggulangan; $i++) {
            $status = $arrStatus[$i];

            $participant = new Participant;
            $participant->nama = $data[$status . '_nama'];
            $participant->kelas = $data[$status . '_kelas'];
            $participant->email = $data[$status . '_email'];
            $participant->telp_peserta = $data[$status . '_telp'];

            $participant->status = str_replace(' ', '', $status); // Without space

            $file = request()->file($status . '_foto_upload');
            $file->storeAs('public/foto/' . $user->username, $status . '.png', ['disks' => 'public']);
            $participant->kartu_pelajar = 'storage/foto/' . $user->username . "/" . $status . '.png';

            $team->participants()->save($participant);
        }

        return $user;
    }
}
