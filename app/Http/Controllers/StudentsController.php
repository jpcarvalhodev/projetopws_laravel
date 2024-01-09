<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::all();

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        try {
            $student = new Student();

            $student->name = $request->name;
            $student->email = $request->email;
            $student->birthdate = $request->birthdate;
            $student->nif = $request->nif;

            $student->save();

        }catch(\Exception $error){

            return response()->json([
                "status" => false,
                "message" => 'Ocorreu um erro no servidor',
                "data" => [$error]
            ],500);
        }

        return response()->json($student,201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $unit = Student::where('id', $id)->get()->first();

        if (!$unit) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o estudante",
                "data" => [$unit],
            ], 400);
        }

        return response()->json($unit, 200);
    }

    public function count()
    {
        $studentsCount = Student::count();

        return response()->json($studentsCount, 200);
    }

    public function getStudents(Request $request)
    {
        $students = Student::when($request->filled('name'), function ($query) use ($request){
            return $query->where(
            \DB::raw('LOWER(name)'),
            'like',
            '%' . strtolower($request->input('name')) . '%'
            );
        })
        ->get();

        return response()->json($students, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, $id)
    {
        $doesStudentExist = Student::where('id', $id)->exists();

        if (!$doesStudentExist) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o estudante",
                "data" => [$doesStudentExist],
            ], 400);
        }

        $student = Student::where('id','=', $id)->first();

        $student->name = $request->name;
        $student->email = $request->email;
        $student->birthdate = $request->birthdate;
        $student->nif = $request->nif;

        $student->save();

        return response()->json($student,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        $doesStudentExist = Student::where('id', $id)->exists();

        if (!$doesStudentExist) {
            return response()->json([
                "status" => false,
                "message" => "Não foi possível encontrar o estudante",
                "data" => [$doesStudentExist],
            ], 400);
        }

        $student = Student::where('id','=', $id)->first();

        $student->delete();

        return response()->json([
            "status" => true,
            "message" => "Estudante deletado com sucesso",
            "data" => [$student],
        ], 200);
    }
}
