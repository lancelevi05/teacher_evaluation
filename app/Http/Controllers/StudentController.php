<?php

namespace App\Http\Controllers;
use App\Models\student_info;
use App\Models\StrandCourse;
use App\Models\User;
use App\Models\Teacher;
use App\Models\TeacherAssignment;
use App\Models\Semester;
use App\Models\Subject;
use App\Models\Evaluation;
use App\Models\EvaluationAnswer;
use App\Models\Question;
use App\Models\QuestionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    //


    public function home()
    {
        $userId = Auth::id();

        // Use 'students' if that's a real separate table, or switch to 'student_infos' — see note below
        $student = DB::table('student_infos')->where('user_id', $userId)->first();

        // if (!$student) {
        //     return view('StudentSide.dashboard-missing');
        // }

        $pending = DB::table('teacher_assignments as ta')
            ->join('semesters as sem', 'ta.semester_id', '=', 'sem.id')
            ->where('sem.status', 'active')
            ->whereNotExists(function ($query) use ($student) {
                $query->select(DB::raw(1))
                    ->from('evaluations as e')
                    ->whereColumn('e.teacher_id', 'ta.teacher_id')
                    ->whereColumn('e.subject_id', 'ta.subject_id')
                    ->whereColumn('e.semester_id', 'ta.semester_id')
                    ->where('e.student_id', $student->id);
            })
            ->count();

        $completed = DB::table('evaluations')
            ->where('student_id', $student->id)
            ->count();

        $recent = DB::table('evaluations as e')
            ->join('teachers as t', 'e.teacher_id', '=', 't.id')
            ->join('users as u', 't.user_id', '=', 'u.id')
            ->join('subjects as sub', 'e.subject_id', '=', 'sub.id')
            ->where('e.student_id', $student->id)
            ->orderByDesc('e.created_at')           // was submitted_at
            ->limit(5)
            ->select(
                'e.*',
                DB::raw("CONCAT(u.fname, ' ', u.lname) as teacher_name"), // was u.name
                'sub.name as subject_name'
            )
            ->get();

            // Attach label + css class per row so the blade stays dumb
        $recent = $recent->map(function ($r) {
            $r->rating_label = $this->ratingLabel($r->overall_rating);
            $r->rating_class = $this->ratingClass($r->overall_rating);
            return $r;
        });


          

        return view('StudentSide.home', compact('pending', 'completed', 'recent'));
    }


    public function infosettings()
    {
        $studentInfo = student_info::where('usn', Auth::user()->usn)->first();
        $StrandCourse = StrandCourse::all();
        return view("StudentSide.infosettings", compact("studentInfo", "StrandCourse"));
    }

    public function updateInfo(Request $request)
    {
        $request->validate([
            'shs_college' => 'required',
            'idstrandcourse' => 'required',
            'year_level' => 'required',
            'section' => 'required',
        ]);

        student_info::updateOrCreate(
            ['usn' => Auth::user()->usn],
            [
                'shs_college' => $request->shs_college,
                'idstrandcourse' => $request->idstrandcourse,
                'yglevel' => $request->year_level,
                'section' => $request->section,
            ]
        );

        return redirect()
            ->route('infosettings')
            ->with('success', 'Student information updated successfully!');
    }

    public function studentEvaluate(Request $request)
    {
        $student = Auth::user()->student;

        if (!$student) {
            return view('StudentSide.evaluate', ['noProfile' => true]);
        }

        $assignmentId = $request->query('assignment_id');

        // ---- Step 2: show the form for a chosen assignment ----
        if ($assignmentId) {
            $assignment = TeacherAssignment::with('teacher.user', 'subject', 'semester.academicyear')
                ->find($assignmentId);

            if (!$assignment) {
                return redirect()->route('student.evaluate')
                    ->with('error', 'Invalid assignment.');
            }

            $alreadyEvaluated = Evaluation::where('student_id', $student->id)
                ->where('teacher_id', $assignment->teacher_id)
                ->where('subject_id', $assignment->subject_id)
                ->where('semester_id', $assignment->semester_id)
                ->exists();

            if ($alreadyEvaluated) {
                return redirect()->route('student.evaluate')
                    ->with('error', 'You have already evaluated this teacher for this subject.');
            }

            $categories = QuestionCategory::orderBy('id')
                ->with([
                    'questions' => function ($q) {
                        $q->where('is_active', 1)->orderBy('id');
                    }
                ])
                ->get()
                ->filter(fn($c) => $c->questions->isNotEmpty())
                ->values();

            return view('StudentSide.evaluate', [
                'selectedAssignment' => $assignment,
                'categories' => $categories,
            ]);
        }

        // ---- Step 1: list assignments not yet evaluated ----
        $evaluates = TeacherAssignment::with('teacher.user', 'subject', 'semester.academicyear')
            ->whereHas('semester', fn($q) => $q->where('status', 'active'))
            ->whereNotExists(function ($query) use ($student) {
                $query->select(DB::raw(1))
                    ->from('evaluations')
                    ->whereColumn('evaluations.teacher_id', 'teacher_assignments.teacher_id')
                    ->whereColumn('evaluations.subject_id', 'teacher_assignments.subject_id')
                    ->whereColumn('evaluations.semester_id', 'teacher_assignments.semester_id')
                    ->where('evaluations.student_id', $student->id);
            })
            ->get()
            ->sortBy(fn($a) => $a->teacher->user->fname ?? '')
            ->values();

        return view('StudentSide.evaluate', [
            'evaluates' => $evaluates,
        ]);
    }

    public function storeEvaluation(Request $request)
    {
        $student = Auth::user()->student;
        abort_if(!$student, 403);

        $request->validate([
            'assignment_id' => 'required|exists:teacher_assignments,id',
        ]);

        $assignment = TeacherAssignment::findOrFail($request->assignment_id);

        $alreadyEvaluated = Evaluation::where('student_id', $student->id)
            ->where('teacher_id', $assignment->teacher_id)
            ->where('subject_id', $assignment->subject_id)
            ->where('semester_id', $assignment->semester_id)
            ->exists();

        if ($alreadyEvaluated) {
            return redirect()->route('student.evaluate')
                ->with('error', 'You have already evaluated this teacher for this subject.');
        }

        $questions = Question::where('is_active', 1)->get();

        $ratings = [];
        $answersToInsert = [];

        foreach ($questions as $q) {
            $field = 'q_' . $q->id;

            if ($q->type === 'text') {
                $answersToInsert[] = [
                    'question_id' => $q->id,
                    'rating' => null,
                    'answer_text' => trim($request->input($field, '')),
                ];
            } else {
                $rating = $request->filled($field) ? (int) $request->input($field) : null;
                if ($rating) {
                    $ratings[] = $rating;
                }
                $answersToInsert[] = [
                    'question_id' => $q->id,
                    'rating' => $rating,
                    'answer_text' => null,
                ];
            }
        }

        $overallRating = count($ratings) ? round(array_sum($ratings) / count($ratings), 2) : null;

        DB::beginTransaction();
        try {
            $evaluation = Evaluation::create([
                'student_id' => $student->id,
                'teacher_id' => $assignment->teacher_id,
                'subject_id' => $assignment->subject_id,
                'semester_id' => $assignment->semester_id,
                'is_anonymous' => $request->boolean('anonymous'),
                'overall_rating' => $overallRating,
            ]);

            foreach ($answersToInsert as $a) {
                EvaluationAnswer::create(array_merge(['evaluation_id' => $evaluation->id], $a));
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return redirect()->route('student.evaluate')
                ->with('error', 'Failed to submit: ' . $e->getMessage());
        }

        return redirect()->route('student.history')
            ->with('success', 'Your evaluation was submitted successfully. Thank you!');
    }

    public function studentHistory()
    {
        $student = Auth::user()->student;

        if (!$student) {
            return view('StudentSide.history', ['noProfile' => true]);
        }

        $evaluations = Evaluation::with('teacher.user', 'subject', 'semester.academicyear')
            ->where('student_id', $student->id)
            ->orderByDesc('created_at')
            ->get();

        return view('StudentSide.history', [
            'evaluations' => $evaluations,
        ]);
    }

    private function ratingLabel($rating)
    {
        if ($rating === null)
            return 'No Data';
        if ($rating >= 4.5)
            return 'Excellent';
        if ($rating >= 3.5)
            return 'Good';
        if ($rating >= 2.5)
            return 'Average';
        return 'Poor';
    }

    /**
     * Maps an average rating to the matching CSS class
     * from the .performance-* styles in the Blade view.
     */
    private function ratingClass($rating)
    {
        if ($rating === null)
            return 'performance-nodata';
        if ($rating >= 4.5)
            return 'performance-excellent';
        if ($rating >= 3.5)
            return 'performance-good';
        if ($rating >= 2.5)
            return 'performance-average';
        return 'performance-poor';
    }
}
