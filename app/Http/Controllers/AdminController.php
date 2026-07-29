<?php

namespace App\Http\Controllers;
use App\Models\auditLog;
use Illuminate\Support\Facades\Auth;


use App\Models\StrandCourse;
use App\Models\Department;
use App\Models\User;
use App\Models\student_info;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use App\Models\Subject;
use App\Models\Question;
use App\Models\QuestionCategory;
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
        // } hi

    }

    public function home(Request $request)
    {
        $totalcourses = StrandCourse::count();



        return view('AdminSide.home', [
            'user' => $request->user(),
            'totalcourses' => $totalcourses,
        ]);
    }



    public function auditLOG()
    {
        $auditLogs = auditLog::with('user')
            ->latest()
            ->paginate(20);

        return view('AdminSide.audit_logs', compact('auditLogs'));
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

        // ===========================
        // AUDIT LOG
        // ===========================
        auditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Add Course',
            'details' => 'Added course: ' . $request->strandcourse,
        ]);

        // redirect back with message
        return redirect()
            ->route('courses.index')
            ->with('success', 'Course added successfully!');
    }

    // public function updateCourse(Request $request, $id)
    // {
    //     $course = StrandCourse::findOrFail($id);

    //     $course->update([
    //         'idstrandcourse' => $request->idstrandcourse,
    //         'strandcourse' => $request->strandcourse,
    //         'department_id' => $request->department_id,
    //         'max_section' => $request->max_section,
    //         'shs_college' => $request->shs_college,
    //     ]);

    //     return redirect()->route('courses.index')
    //         ->with('success', 'Course updated successfully.');
    // }

    public function updateCourse(Request $request, StrandCourse $course)
    {
        $validated = $request->validate([
            'idstrandcourse' => 'required|string|max:20',
            'strandcourse' => 'required|string|max:100',
            'department_id' => 'required|exists:departments,id',
            'max_section' => 'required|integer|min:1',
            'shs_college' => 'required|string|max:100',
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
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


        $strandCourses = DB::table('strand_courses')->get();
        return view('AdminSide.students', compact('students', 'student_info', 'strandCourses'));
    }

    public function storeStudentList(Request $request)
    {
        $validated = $request->validate([
            'usn' => 'required|string|unique:users,usn',
            'email' => 'required|email|unique:users,email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mname' => 'nullable|string',
            'password' => 'required|string|min:6',
            'shs_college' => 'required',
            'idstrandcourse' => 'required',
            'yglevel' => 'required',
            'section' => 'required',
        ]);

        $user = User::create([
            'usn' => $validated['usn'],
            'email' => $validated['email'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'mname' => $validated['mname'],
            'password' => bcrypt($validated['password']),
            'userType' => 'Student',
        ]);

        DB::table('student_infos')->insert([
            'user_id' => $user->id,
            'usn' => $user->usn,
            'idstrandcourse' => $validated['idstrandcourse'],
            'yglevel' => $validated['yglevel'],
            'section' => $validated['section'],
            'shs_college' => $validated['shs_college'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Student added successfully.');
    }

    public function updateStudentList(Request $request, User $user)
    {
        $validated = $request->validate([
            'usn' => 'required|string|unique:users,usn,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mname' => 'nullable|string',
            'password' => 'nullable|string|min:6',
            'shs_college' => 'required',
            'idstrandcourse' => 'required',
            'yglevel' => 'required',
            'section' => 'required',
        ]);

        $user->update([
            'usn' => $validated['usn'],
            'email' => $validated['email'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'mname' => $validated['mname'],
            ...(!empty($validated['password']) ? ['password' => bcrypt($validated['password'])] : []),
        ]);

        DB::table('student_infos')->updateOrInsert(
            ['usn' => $user->usn],
            [
                'user_id' => $user->id,
                'idstrandcourse' => $validated['idstrandcourse'],
                'yglevel' => $validated['yglevel'],
                'section' => $validated['section'],
                'shs_college' => $validated['shs_college'],
                'updated_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    public function destroyStudentList(User $user)
    {
        DB::table('student_infos')->where('usn', $user->usn)->delete();
        $user->delete();

        return redirect()->back()->with('success', 'Student removed successfully.');
    }

    public function teacherList()
    {

        // Sync teachers table with users table
        $teacherUsers = User::where('userType', 'Teacher')->get();

        foreach ($teacherUsers as $user) {
            Teacher::firstOrCreate(
                ['user_id' => $user->id], // Check if already exists
                [
                    'department_id' => null,
                    'employee_id' => null,
                ]
            );
        }




        $teachers = User::where('userType', 'Teacher')->get();

        $teacher_info = DB::table('teachers')
            ->leftJoin('departments', 'teachers.department_id', '=', 'departments.id')
            ->leftJoin('evaluations', 'teachers.id', '=', 'evaluations.teacher_id')
            ->select(
                'teachers.*',
                'departments.name as department_name',
                DB::raw('COUNT(DISTINCT evaluations.student_id) as evaluations_count'),
                DB::raw('ROUND(AVG(evaluations.overall_rating), 2) as rating')
            )
            ->groupBy(
                'teachers.id',
                'teachers.user_id',
                'teachers.department_id',
                'teachers.employee_id',
                'teachers.created_at',
                'teachers.updated_at',
                'departments.name'
            )
            ->get();

        $departments = DB::table('departments')->get();

        return view('AdminSide.teachers', compact(
            'teachers',
            'teacher_info',
            'departments'
        ));
    }


    public function storeTeacherList(Request $request)
    {
        $validated = $request->validate([
            'usn' => 'nullable|string|unique:users,usn',
            'email' => 'required|email|unique:users,email',
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mname' => 'nullable|string',
            'status' => 'required|in:Active,Inactive,Retired',
            'password' => 'required|string|min:6',
            'employee_id' => 'required|string|unique:teachers,employee_id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $user = User::create([
            'usn' => $validated['employee_id'] ?? null,
            'email' => $validated['email'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'mname' => $validated['mname'],
            'status' => $validated['status'],
            'password' => bcrypt($validated['password']),
            'userType' => 'Teacher',

        ]);

        DB::table('teachers')->insert([
            'user_id' => $user->id,
            'department_id' => $validated['department_id'],
            'employee_id' => $validated['employee_id'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Teacher added successfully.');
    }

    public function updateTeacherList(Request $request, User $user)
    {
        $validated = $request->validate([
            'usn' => 'nullable|string|unique:users,usn,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fname' => 'required|string',
            'lname' => 'required|string',
            'mname' => 'nullable|string',
            'status' => 'required|in:Active,Inactive,Retired',
            'password' => 'nullable|string|min:6',
            'employee_id' => 'required|string|unique:teachers,employee_id,' . $user->id . ',user_id',
            'department_id' => 'required|exists:departments,id',
        ]);

        $user->update([
            'usn' => $validated['employee_id'] ?? null,
            'email' => $validated['email'],
            'fname' => $validated['fname'],
            'lname' => $validated['lname'],
            'mname' => $validated['mname'],
            'status' => $validated['status'],
            ...(!empty($validated['password']) ? ['password' => bcrypt($validated['password'])] : []),
        ]);

        DB::table('teachers')->updateOrInsert(
            ['user_id' => $user->id],
            [
                'department_id' => $validated['department_id'],
                'employee_id' => $validated['employee_id'],
                'updated_at' => now(),
            ]
        );

        return redirect()->back()->with('success', 'Teacher updated successfully.');
    }
    public function destroyTeacherList(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'Teacher removed successfully.');
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

    public function openAcademic(Request $request, $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $academicYear->update([
            'status' => 'active'

        ]);

        return redirect()->route('academicsemesters.index')
            ->with('success', 'Semester Opened successfully.');
    }

    public function closeAcademic($id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $academicYear->update([
            'status' => 'archived',
        ]);

        return redirect()->route('academicsemesters.index')
            ->with('success', 'Academic Archived successfully.');
    }

    public function storeSemester(Request $request)
    {
        // validation
        $request->validate([
            'academic_year_id' => 'required|integer|exists:academic_years,id',
            'name' => 'required|string|max:100',




        ]);


        // insert data
        Semester::create([
            'academic_year_id' => $request->academic_year_id,
            'name' => $request->name,
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

    public function questionnaire()
    {

        $categories = QuestionCategory::with('questions')->get();

        return view('AdminSide.questionnaire', compact('categories'));
    }

    public function toggleQuestion(Question $question)
    {
        $question->update([
            'is_active' => !$question->is_active,
        ]);

        return redirect()
            ->route('questionnaire.index')
            ->with('success', 'Question status updated successfully.');
    }

    public function storequestionnaire(Request $request)
    {
        $request->validate([
            'category_id' => 'required|integer|exists:question_categories,id',
            'question_text' => 'required|string',
            'type' => 'required|in:likert,multiple_choice,text,checkbox,yes_no',

        ]);


        // insert data
        Question::create([
            'category_id' => $request->category_id,
            'question_text' => $request->question_text,
            'type' => $request->type,

        ]);

        // redirect back with message
        return redirect()
            ->route('questionnaire.index')
            ->with('success', 'Question added successfully!');
    }

    public function storecategory(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:100',
            'description' => 'required|string|max:100',


        ]);


        // insert data
        QuestionCategory::create([
            'name' => $request->name,
            'description' => $request->description,


        ]);

        // redirect back with message
        return redirect()
            ->route('questionnaire.index')
            ->with('success', 'Category added successfully!');
    }

    public function destroycategory($id)
    {
        $category = QuestionCategory::findOrFail($id);

        $category->delete();

        return redirect()->route('questionnaire.index')
            ->with('success', 'Category deleted successfully.');
    }


    public function teacherassignment()
    {
        $assignments = TeacherAssignment::with('teacher.user', 'subject', 'semester.academicyear')->get();

        $teachers = Teacher::all();
        $semesters = Semester::all();

        $subjects = Subject::all();
        $users = User::all();


        return view("AdminSide.teacherassignment", compact('assignments', 'teachers', 'semesters', 'subjects', 'users'));
    }

    public function storeteacherassignment(Request $request)
    {
        $validated = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'subject_id' => 'required|exists:subjects,id',
            'semester_id' => 'required|exists:semesters,id',
            'section' => 'nullable|string|max:100',
        ]);

        TeacherAssignment::create($validated);

        return back()->with('success', 'Assignment created successfully.');
    }

    public function destroyteacherassignment($id)
    {
        $teacher = TeacherAssignment::findOrFail($id);

        $teacher->delete();

        return redirect()->route('teacherassignment.index')
            ->with('success', 'Teacher deleted successfully.');
    }

}
