<?php

namespace App\Http\Controllers;
use App\Models\student_info;
use App\Models\StrandCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    //
    public function infosettings(){
        $studentInfo = student_info::where('usn', Auth::user()->usn)->first();
        $StrandCourse = StrandCourse::all();
        return view("StudentSide.infosettings",compact("studentInfo", "StrandCourse"));
    }

    public function updateInfo(Request $request)
{
    $request->validate([
        'category' => 'required',
        'idstrandcourse' => 'required',
        'year_level' => 'required',
        'section' => 'required',
    ]);

    student_info::updateOrCreate(
        ['usn' => Auth::user()->usn],
        [
            'shs_college' => $request->category,
            'idstrandcourse' => $request->idstrandcourse,
            'yglevel' => $request->year_level,
            'section' => $request->section,
        ]
    );

    return redirect()
        ->route('infosettings')
        ->with('success', 'Student information updated successfully!');
}
}
