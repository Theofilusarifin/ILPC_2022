<?php

namespace App\Http\Controllers\Sekretariat;

use App\Http\Controllers\Controller;
use App\Models\Regency;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::orderBy('id', 'desc')->paginate(12);
        $regencies = Regency::all();
        return view("sekretariat.schools.index", compact('schools', 'regencies'));
    }

    public function store(Request $request)
    {
        School::create(
            [
                'nama' => $request["school_nama"],
                'alamat' => $request["school_alamat"],
                'regency_id' => $request["regency_id"]
            ],
        );
        session()->flash('success', 'New School Succesfully Created');
        return redirect()->to(route('sekretariat.schools.index'));
    }

    public function update(Request $request, School $school)
    {
        $school->update(
            [
                'nama' => $request["school_nama"],
                'alamat' => $request["school_alamat"],
                'regency_id' => $request["regency_id"]
            ],
        );

        session()->flash("success", "School $school->id successfully updated");
        return redirect()->to(route('sekretariat.schools.index'));
    }

    public function destroy(School $school)
    {
        $school->delete();
        session()->flash('success', "Sekolah ID $school->id successfully deleted");
        return redirect()->to(route('sekretariat.schools.index'));
    }


    public function search()
    {
        $searchByAvailable = ["schools.nama", "alamat", "regencies.nama"];
        $searchBy = request()->get('searchBy');
        $keyword = request()->get('keyword');

        if(!in_array($searchBy, $searchByAvailable)){
            abort(404);
        }

        $schools = School::select('schools.*', 'regencies.nama AS kabupaten')
            ->join('regencies', "schools.regency_id", "=", "regencies.id")
            ->where("$searchBy", 'LIKE', "%$keyword%")->orderBy('id', 'desc')
            ->paginate(12);
        $regencies = Regency::all();

        session()->flash("keyword", $keyword);

        return view("sekretariat.schools.index", compact('schools', 'regencies'));
    }

    
    public function getSchoolDataToEdit()
    {
        $school = School::where('id', request("school_id"))->get();
        $regencies = Regency::all();

        return response()->json(array(
            'school' => $school,
            'regencies' => $regencies
        ), 200);
    }
}
