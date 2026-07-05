<?php

namespace App\Http\Controllers;
use App\Models\StrandCourse;
use App\Models\Department;
use App\Models\User;
use App\Models\student_info;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        
        $sections = StrandCourse::all();
        return view('AdminSide.sections', compact('sections'));
    }

    public function sections()
    {
        $sections = StrandCourse::all();
        $departments = Department::all();
        
        return view('AdminSide.sections', compact('sections','departments'));
    }
     // ✅ SAVE TO DATABASE
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'idstrandcourse' => 'required',
            'strandcourse' => 'required|string|max:100',
            'max_section' => 'required|integer',
            'shs_college' => 'required|integer'
        ]);

        // insert data
        StrandCourse::create([
            'idstrandcourse' => $request->idstrandcourse,
            'strandcourse'   => $request->strandcourse,
            'max_section'    => $request->max_section,
            'shs_college'    => $request->shs_college,
        ]);

        // redirect back with message
        return redirect()
            ->route('sections.index')
            ->with('success', 'Section added successfully!');
    }

    public function departments()
    {
        $teachers = User::where('userType', 'Teacher')->get();
        $departments = Department::all();
        
        return view('AdminSide.departments', compact('departments','teachers'));
        
    }

    public function storeDepartment(Request $request){
        // validation
        $request->validate([
            'name' => 'required',
            'code' => 'required|string|max:100',
            'head_id' => 'nullable|exists:users,id',
          
        ]);

        // insert data
        Department::create([
            'name' => $request->name,
            'code'   => $request->code,
            'head_id'    => $request->head_id,
         
        ]);

        // redirect back with message
        return redirect()
            ->route('departments.index')
            ->with('success', 'Departments added successfully!');

    }
    public function studentList(){
         $students = User::where('userType', 'Student')->get();
          $student_info = student_info::all();
       
        
        return view('AdminSide.students', compact('students','student_info'));
        
    }
}

