<?php

namespace App\Http\Controllers;

use App\Models\AcademicProgram;
use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FacultyController extends Controller
{
    function show()
    {
        $faculties = Faculty::all();
        $academic_programs = AcademicProgram::all();

        return view('faculties.faculty', [
            'active' => 'faculty',
            'faculties' => $faculties,
            'academic_programs' => $academic_programs
        ]);
    }

    function addFaculty(Request $request)
    {
        Faculty::create([
            'id' => Str::uuid(),
            'faculty' => $request->name
        ]);

        return response()->json([
            'message' => 'Sukses Menambah Fakultas'
        ]);
    }

    function editFaculty(Request $request)
    {
        $faculty = Faculty::find($request->id);

        $faculty->update([
            'faculty' => $request->name
        ]);

        return response()->json([
            'faculty' => $faculty,
            'message' => 'Sukses Memperbarui Fakultas'
        ]);
    }

    function deleteFaculty(Request $request)
    {
        $faculty = Faculty::find($request->id);

        $faculty->delete();

        return response()->json([
            'message' => 'Sukses menghapus Fakultas'
        ]);
    }

    /**
     * Academic Program
     */

    function addAcademicProgram(Request $request)
    {
        AcademicProgram::create([
            'id' => Str::uuid(),
            'name' => $request->academicProgram,
            'faculty_id' => $request->facultyID
        ]);

        return response()->json([
            'message' => 'Sukses Menambah Program Studi'
        ]);
    }

    function editAcademicProgram(Request $request)
    {
        $ap = AcademicProgram::find($request->academicProgramID);

        $ap->update([
            'name' => $request->academicProgram,
            'faculty_id' => $request->facultyID
        ]);

        return response()->json([
            'message' => 'Sukses Memperbarui Program Studi'
        ]);
    }

    function deleteAcademicProgram(Request $request)
    {
        $academicProgram = AcademicProgram::find($request->id);

        $academicProgram->delete();

        return response()->json([
            'message' => 'Sukses Menghapus Program Studi'
        ]);
    }

    /**
     * API
     */
    function getFaculties()
    {
        $faculties = Faculty::all();

        return response()->json([
            'data' => $faculties
        ]);
    }

    function getAcademicPrograms()
    {
        $academic_programs = AcademicProgram::all();

        return response()->json([
            'data' => $academic_programs
        ]);
    }

    function getAcademicProgram(Request $request)
    {
        $academic_programs = AcademicProgram::all();

        return response()->json([
            'data' => $academic_programs
        ]);
    }
}
