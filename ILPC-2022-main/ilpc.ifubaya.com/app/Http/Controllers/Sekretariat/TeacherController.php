<?php

namespace App\Http\Controllers\Sekretariat;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'desc')->paginate(12);
        $schools = School::all();
        return view("sekretariat.teachers.index", compact('teachers', 'schools'));
    }

    public function store(Request $request)
    {
        Teacher::create(
            [
                'nama' => $request["teacher_nama"],
                'telp' => $request["teacher_telp"],
                'email' => $request["teacher_email"],
                'alamat' => $request["teacher_alamat"],
                'alergi' => $request["teacher_alergi"],
                'vegetarian' => $request["teacher_vegetarian"],
                'school_id' => $request["school_id"],
            ],
        );

        session()->flash('success', 'New Teacher Succesfully Created');
        return redirect()->to(route('sekretariat.teachers.index'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $teacher->update(
            [
                'nama' => $request["teacher_nama"],
                'telp' => $request["teacher_telp"],
                'email' => $request["teacher_email"],
                'alamat' => $request["teacher_alamat"],
                'alergi' => $request["teacher_alergi"],
                'vegetarian' => $request["teacher_vegetarian"],
                'school_id' => $request["school_id"],
            ],
        );

        session()->flash("success", "School $teacher->id successfully updated");
        return redirect()->to(route('sekretariat.teachers.index'));
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        session()->flash('success', "Guru ID $teacher->id successfully deleted");
        return redirect()->to(route('sekretariat.teachers.index'));
    }

    
    public function search()
    {
        $searchByAvailable = ["teachers.nama", "teachers.telp", "teachers.email", "schools.nama"];
        $searchBy = request()->get('searchBy');
        $keyword = request()->get('keyword');

        if(!in_array($searchBy, $searchByAvailable)){
            abort(404);
        }

        $teachers = Teacher::select('teachers.*', 'schools.nama AS nama_sekolah')
            ->join('schools', "teachers.school_id", "=", "schools.id")
            ->where("$searchBy", 'LIKE', "%$keyword%")->orderBy('id', 'desc')
            ->paginate(12);
        $schools = School::all();

        session()->flash("keyword", $keyword);

        return view("sekretariat.teachers.index", compact('teachers', 'schools'));
    }

    
    public function getTeacherDataToEdit()
    {
        $teacher = Teacher::where('id', request("teacher_id"))->get();
        $schools = School::all();

        return response()->json(array(
            'teacher' => $teacher,
            'schools' => $schools
        ), 200);
    }
}
