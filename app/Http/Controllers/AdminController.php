<?php

namespace App\Http\Controllers;
use App\Models\StrandCourse;
use App\Models\Department;
use App\Models\User;
use App\Models\student_info;
use App\Models\Subject;
use App\Models\Semester;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function index()
    {

        // $sections = StrandCourse::all();
        // return view('AdminSide.sections', compact('sections'));


        //  if (Auth::id()) {
        //     $usertype = Auth()->user()->usertype;

        //     if ($usertype == "user") {
        //         $room = Room::all();
        //         $gallery = Gallery::all();
        //         return view('home.index',compact('room','gallery'));
        //     } else if ($usertype == "admin") {
        //         return view("admin.index");
        //     } else {
        //         return redirect()->back();
        //     }
        // }

    }

    public function home(Request $request)
    {
        $totalcourses = StrandCourse::count();



        return view('AdminSide.home', [
            'user' => $request->user(),
            'totalcourses' => $totalcourses,
        ]);
    }

    public function courses()
    {

        $departments = Department::all();
        $courses = StrandCourse::all();


        foreach ($courses as $course) {
            $course->students_count = student_info::where('idstrandcourse', $course->idstrandcourse)->count();
        }



        return view('AdminSide.courses', compact('courses', 'departments'));
    }
    // ✅ SAVE TO DATABASE
    public function store(Request $request)
    {
        // validation
        $request->validate([
            'idstrandcourse' => 'required|unique:strand_courses,idstrandcourse',
            'strandcourse' => 'required|string|max:100',
            'department_id' => 'required|integer|exists:departments,id',
            'max_section' => 'required|integer',
            'shs_college' => 'required|integer'
        ], [
            'idstrandcourse.unique' => 'This course code already exists.',
        ]);


        // insert data
        StrandCourse::create([
            'idstrandcourse' => $request->idstrandcourse,
            'strandcourse' => $request->strandcourse,
            'department_id' => $request->department_id,
            'max_section' => $request->max_section,
            'shs_college' => $request->shs_college,
        ]);

        // redirect back with message
        return redirect()
            ->route('courses.index')
            ->with('success', 'Course added successfully!');

    }

    public function updateCourse(Request $request, $id)
    {
        $course = StrandCourse::findOrFail($id);

        $course->update([
            'idstrandcourse' => $request->idstrandcourse,
            'strandcourse' => $request->strandcourse,
            'department_id' => $request->department_id,
            'max_section' => $request->max_section,
            'shs_college' => $request->shs_college,
        ]);

        return redirect()->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroyCourse($id)
    {
        $section = StrandCourse::findOrFail($id);

        $section->delete();

        return redirect()->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }

    public function departments()
    {
        $teachers = User::where('userType', 'Teacher')->get();
        $departments = Department::all();

        foreach ($departments as $department) {
            $department->courses_count = StrandCourse::where('department_id', $department->id)->count();
        }


        return view('AdminSide.departments', compact('departments', 'teachers'));

    }

    public function storeDepartment(Request $request)
    {
        // validation
        $request->validate([
            'name' => 'required',
            'code' => 'required|string|max:100',
            'head_id' => 'nullable|exists:users,id',

        ]);

        // insert data
        Department::create([
            'name' => $request->name,
            'code' => $request->code,
            'head_id' => $request->head_id,

        ]);

        // redirect back with message
        return redirect()
            ->route('departments.index')
            ->with('success', 'Departments added successfully!');

    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::findOrFail($id);

        $department->update([

            'name' => $request->name,
            'code' => $request->code,
            'head_id' => $request->head_id,
        ]);

        return redirect()->route('departments.index')
            ->with('success', 'Department updated successfully.');
    }

    public function destroyDepartment($id)
    {
        $department = Department::findOrFail($id);

        try {
            $department->delete();

            return redirect()->route('departments.index')
                ->with('success', 'Department deleted successfully.');

        } catch (QueryException $e) {

            // MySQL Error 1451 = Foreign key constraint
            if ($e->errorInfo[1] == 1451) {
                return redirect()->route('departments.index')
                    ->with('error', 'Cannot delete this department because it is being used by one or more strand/course records.');
            }

            // Any other database error
            return redirect()->route('departments.index')
                ->with('error', 'An unexpected error occurred while deleting the department.');
        }
    }



    public function studentList()
    {
        $students = User::where('userType', 'Student')->get();
        // $student_info = student_info::all();

        $student_info = DB::table('student_infos')
            ->leftJoin('strand_courses', 'student_infos.idstrandcourse', '=', 'strand_courses.idstrandcourse')
            ->select(
                'student_infos.*',
                'strand_courses.strandcourse'
            )
            ->get();


        return view('AdminSide.students', compact('students', 'student_info'));

    }



    public function subjects()
    {

        $departments = Department::all();
        $subjects = Subject::all();



        return view('AdminSide.subjects', compact('subjects', 'departments'));
    }
    // ✅ SAVE TO DATABASE
    public function storeSubject(Request $request)
    {
        // validation
        $request->validate([
            'department_id' => 'required|integer|exists:departments,id',
            'code' => 'required|unique:subjects,code',
            'name' => 'required|string|max:100',


            'units' => 'required|decimal:0,1|between:0,99.9',
        ], [
            'code.unique' => 'This code already exists.',
        ]);


        // insert data
        Subject::create([
            'department_id' => $request->department_id,
            'code' => $request->code,
            'name' => $request->name,


            'units' => $request->units,
        ]);

        // redirect back with message
        return redirect()
            ->route('subjects.index')
            ->with('success', 'Section added successfully!');

    }

    public function updateSubject(Request $request, $id)
    {
        $subject = Subject::findOrFail($id);

        $subject->update([
            'department_id' => $request->department_id,
            'code' => $request->code,

            'name' => $request->name,
            'units' => $request->units,
        ]);

        return redirect()->route('subjects.index')
            ->with('success', 'Subject updated successfully.');
    }

    public function destroySubject($id)
    {
        $subject = Subject::findOrFail($id);

        $subject->delete();

        return redirect()->route('subjects.index')
            ->with('success', 'Subject deleted successfully.');
    }

    public function academicsemesters()
    {
        $academicYears = AcademicYear::orderByDesc('id')->get();
        $semesters = Semester::all();


        return view('AdminSide.academicsemesters', compact('academicYears', 'semesters'));
    }

    public function storeAcademic(Request $request)
    {
        // validation
        $request->validate([
            'academic_year' => 'required|unique:academic_years,year_label',



        ], [
            'year_label.unique' => 'This year label already exists.',
        ]);


        // insert data
        AcademicYear::create([
            'year_label' => $request->academic_year,
            'status' => 'active',
        ]);

        // redirect back with message
        return redirect()
            ->route('academicsemesters.index')
            ->with('success', 'Academic Year added successfully!');

    }

    public function storeSemester(Request $request)
    {
        // validation
        $request->validate([
            'academic_year_id' => 'required|integer|exists:academic_years,id',
            'name'=> 'required|string|max:100',
            



        ]);


        // insert data
        Semester::create([
            'academic_year_id' => $request->academic_year_id,
            'name'=>$request->name,
            'status' => 'active',
        ]);

        // redirect back with message
        return redirect()
            ->route('academicsemesters.index')
            ->with('success', 'Semester added successfully!');

    }
    public function openSemester(Request $request, $id)
    {
        $semester = Semester::findOrFail($id);

        $semester->update([
            'status' => 'active'
            
        ]);

        return redirect()->route('academicsemesters.index')
            ->with('success', 'Semester Opened successfully.');
    }

    public function closeSemester($id)
{
    $semester = Semester::findOrFail($id);

    $semester->update([
        'status' => 'closed',
    ]);

    return redirect()->route('academicsemesters.index')
        ->with('success', 'Semester closed successfully.');
}

}

