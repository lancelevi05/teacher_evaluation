<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\Evaluation;
use App\Models\TeacherAssignment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


use App\Services\PerformanceAnalysisService;


class TeacherController extends Controller
{

public function __construct(
        protected PerformanceAnalysisService $analysis
    ) {}

    
    public function home()
    {
        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return view('TeacherSide.home', [
                'teacher' => null
            ]);
        }

        // Overall Rating and Total Evaluations
        $stats = Evaluation::where('teacher_id', $teacher->id)
            ->selectRaw('AVG(overall_rating) as a, COUNT(*) as c')
            ->first();

        // Subjects Handled
        $subjects = TeacherAssignment::where('teacher_id', $teacher->id)
            ->distinct('subject_id')
            ->count('subject_id');

        // Rating Trend (Last 6 Months)
        $trend = Evaluation::where('teacher_id', $teacher->id)
            ->where('created_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw("DATE_FORMAT(created_at,'%Y-%m') as ym"),
                DB::raw("AVG(overall_rating) as avg_rating")
            )
            ->groupBy('ym')
            ->orderBy('ym')
            ->get();

        return view('TeacherSide.home', compact(
            'teacher',
            'stats',
            'subjects',
            'trend'
        ));
    }

    public function evalResult()
    {

        $teacher = Teacher::where('user_id', Auth::id())->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard');
        }

        // Overall statistics
        $stats = Evaluation::where('teacher_id', $teacher->id)
            ->selectRaw('AVG(overall_rating) as a, COUNT(*) as c')
            ->first();

        // Category Breakdown
        $categories = DB::table('evaluation_answers as ea')
            ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
            ->join('questions as q', 'ea.question_id', '=', 'q.id')
            ->join('question_categories as qc', 'q.category_id', '=', 'qc.id')
            ->where('e.teacher_id', $teacher->id)
            ->whereNotNull('ea.rating')
            ->select(
                'qc.name as category',
                DB::raw('AVG(ea.rating) as avg_rating'),
                DB::raw('COUNT(ea.rating) as n')
            )
            ->groupBy('qc.id', 'qc.name')
            ->get();

        // Performance by Subject
        $subjectRows = DB::table('evaluations as e')
            ->join('subjects as sub', 'e.subject_id', '=', 'sub.id')
            ->where('e.teacher_id', $teacher->id)
            ->select(
                'sub.name as subject_name',
                'sub.code',
                DB::raw('AVG(e.overall_rating) as avg_rating'),
                DB::raw('COUNT(e.id) as n')
            )
            ->groupBy('sub.id', 'sub.name', 'sub.code')
            ->get();

        $averageRating = $stats->a;

        $starHtml = $this->renderStars($averageRating);

        $ratingLabel = $this->analysis->ratingLabel($averageRating);

        $badgeClass = $this->analysis->ratingBadgeClass($averageRating);

        foreach ($subjectRows as $subject) {
            $subject->badgeClass = $this->analysis->ratingBadgeClass($subject->avg_rating);
        }

        return view('TeacherSide.evaluateresult', compact(
            'teacher',
            'stats',
            'categories',
            'subjectRows',
            'starHtml',
            'ratingLabel',
            'badgeClass'
        ));
    }


     // ...evalResult() stays the same...

    public function printReport()
    {
        $teacher = Teacher::with('user')->where('user_id', Auth::id())->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard');
        }

        $stats = Evaluation::where('teacher_id', $teacher->id)
            ->selectRaw('AVG(overall_rating) as a, COUNT(*) as c')
            ->first();

        $categories = DB::table('evaluation_answers as ea')
            ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
            ->join('questions as q', 'ea.question_id', '=', 'q.id')
            ->join('question_categories as qc', 'q.category_id', '=', 'qc.id')
            ->where('e.teacher_id', $teacher->id)
            ->whereNotNull('ea.rating')
            ->select('qc.name as category', DB::raw('AVG(ea.rating) as avg_rating'))
            ->groupBy('qc.id', 'qc.name')
            ->get();

        $comments = DB::table('evaluation_answers as ea')
            ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
            ->join('questions as q', 'ea.question_id', '=', 'q.id')
            ->where('e.teacher_id', $teacher->id)
            ->where('q.type', 'text')
            ->whereNotNull('ea.answer_text')
            ->where('ea.answer_text', '!=', '')
            ->pluck('ea.answer_text')
            ->toArray();

        $catAvgs = [];
        foreach ($categories as $c) {
            $catAvgs[$c->category] = round($c->avg_rating, 2);
        }

        $summary = $this->analysis->buildPerformanceSummary($catAvgs, $comments);

        return view('TeacherSide.printReport', compact(
            'teacher',
            'stats',
            'categories',
            'summary'
        ));
    }

    // remove the old placeholder buildPerformanceSummary() method — no longer need

/**
 * Placeholder port of ai_analysis.php's buildPerformanceSummary().
 * Replace with your actual logic — share ai_analysis.php and I'll port it exactly.
 */


    public function studentComments(PerformanceAnalysisService $analysis)
    {
        $teacher = DB::table('teachers')
            ->where('user_id', Auth::id())
            ->first();

        if (!$teacher) {
            return redirect()->route('teacher.dashboard');
        }

        $comments = DB::table('evaluation_answers as ea')
            ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
            ->join('questions as q', 'ea.question_id', '=', 'q.id')
            ->join('subjects as sub', 'e.subject_id', '=', 'sub.id')
            ->where('e.teacher_id', $teacher->id)
            ->where('q.type', 'text')
            ->whereNotNull('ea.answer_text')
            ->where('ea.answer_text', '!=', '')
            ->select('ea.answer_text', 'e.created_at', 'sub.name as subject_name')
            ->orderByDesc('e.created_at')
            ->get()
            ->map(function ($c) use ($analysis) {
                $result = $analysis->analyzeComment($c->answer_text);
                $c->sentiment = $result['sentiment'];
                $c->keywords = $result['keywords'];
                $c->confidence = $result['confidence'];
                return $c;
            });
        return view('TeacherSide.comments', compact('comments'));
    }

    public function AISuggestions(PerformanceAnalysisService $analysisService)
    {

    $teacher = DB::table('teachers')->where('user_id', Auth::id())->first();

    if (!$teacher) {
        return redirect()->route('teacher.dashboard');
    }

    $categoryAverages = DB::table('evaluation_answers as ea')
        ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
        ->join('questions as q', 'ea.question_id', '=', 'q.id')
        ->join('question_categories as qc', 'q.category_id', '=', 'qc.id')
        ->where('e.teacher_id', $teacher->id)
        ->whereNotNull('ea.rating')
        ->select('qc.name as category', DB::raw('AVG(ea.rating) as avg_rating'))
        ->groupBy('qc.id', 'qc.name')
        ->get()
        ->mapWithKeys(fn ($row) => [$row->category => round($row->avg_rating, 2)])
        ->toArray();

    $comments = DB::table('evaluation_answers as ea')
        ->join('evaluations as e', 'ea.evaluation_id', '=', 'e.id')
        ->join('questions as q', 'ea.question_id', '=', 'q.id')
        ->where('e.teacher_id', $teacher->id)
        ->where('q.type', 'text')
        ->whereNotNull('ea.answer_text')
        ->where('ea.answer_text', '!=', '')
        ->pluck('ea.answer_text')
        ->toArray();

    $summary = (!empty($categoryAverages) || !empty($comments))
        ? $analysisService->buildPerformanceSummary($categoryAverages, $comments)
        : null;


        return view('TeacherSide.ai_suggestions', compact('summary'));
    }


    private function renderStars($rating)
    {
        $rating = round($rating);

        $html = '';

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $html .= '<i class="fa-solid fa-star"></i>';
            } else {
                $html .= '<i class="fa-regular fa-star"></i>';
            }
        }

        return $html;
    }

    // private function ratingLabel($rating)
    // {
    //     if ($rating === null) {
    //         return 'No Data';
    //     }

    //     if ($rating >= 4.5) {
    //         return 'Excellent';
    //     }

    //     if ($rating >= 3.5) {
    //         return 'Very Good';
    //     }

    //     if ($rating >= 2.5) {
    //         return 'Good';
    //     }

    //     if ($rating >= 1.5) {
    //         return 'Fair';
    //     }

    //     return 'Poor';
    // }

    // private function ratingBadgeClass($rating)
    // {
    //     if ($rating === null)
    //         return 'performance-nodata';
    //     if ($rating >= 4.5)
    //         return 'performance-excellent';
    //     if ($rating >= 3.5)
    //         return 'performance-good';
    //     if ($rating >= 2.5)
    //         return 'performance-average';
    //     return 'performance-poor';
    // }
}