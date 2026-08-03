<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// =====================================================
// STUDENT ROUTES
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('/home', function (Request $request) {
        return view('StudentSide.home', [
            'user' => $request->user(),
        ]);
    })->name('StudentSide.home');

    Route::get('/infosettings', [StudentController::class, 'infosettings'])
        ->name('infosettings');

    // ✅ UPDATE STUDENT INFO
    Route::put(
        '/infosettings/update',
        [StudentController::class, 'updateInfo']
    )
        ->name('student.updateInfo');

    //DISPLAY evaluation
    Route::get('/student/evaluate', [StudentController::class, 'studentEvaluate'])
        ->name('student.evaluate');
    Route::post('/student/evaluate', [StudentController::class, 'storeEvaluation'])->name
    ('student.evaluate.store');
    Route::get('/student/history', [StudentController::class, 'studentHistory'])
    ->name('student.history');
});

// =====================================================
// ADMIN ROUTES
// =====================================================
Route::middleware(['auth', 'role:Admin'])->group(function () {
    // Route::get('/admin/home', function (Request $request) {
    //     return view('AdminSide.home', [
    //         'user' => $request->user(),
    //     ]);
    // })->name('AdminSide.home');

    Route::get('/admin/home', [AdminController::class, 'home'])
        ->name('AdminSide.home');

        Route::get('/admin/auditlogs', [AdminController::class, 'auditLOG'])
        ->name('auditLogs.index');


    // Display page
    Route::get('/admin/courses', [AdminController::class, 'courses'])
        ->name('courses.index');
    // Store
    Route::post('/admin/courses', [AdminController::class, 'store'])
        ->name('courses.store');
    // Update
    Route::put('/admin/courses/{id}', [AdminController::class, 'updateCourse'])
        ->name('courses.update');
    // Delete
    Route::delete('/admin/courses/{id}', [AdminController::class, 'destroyCourse'])
        ->name('courses.destroy');




    // route::get('/Departments', [AdminController::class, 'departments']);
    Route::get('/admin/departments', [AdminController::class, 'departments'])
        ->name('departments.index');

    // SAVE DATA ✅
    Route::post('/admin/departments', [AdminController::class, 'storeDepartment'])
        ->name('departments.store');
    // Update
    Route::put('/admin/departments/{id}', [AdminController::class, 'updateDepartment'])
        ->name('departments.update');
    // Delete
    Route::delete('/admin/departments/{id}', [AdminController::class, 'destroyDepartment'])
        ->name('departments.destroy');


    //display student
    Route::get('/admin/students', [AdminController::class, 'studentList'])
        ->name('students.index');

    // SAVE DATA ✅
    Route::post('/admin/students', [AdminController::class, 'storeStudentList'])
        ->name('students.store');
    //UPDATE STUDENT
    Route::put('/admin/students/{user}', [AdminController::class, 'updateStudentList'])
        ->name('students.update');

    //DELETE STUDENT
    Route::delete('/admin/students/{user}', [AdminController::class, 'destroyStudentList'])
        ->name('students.destroy');

    //display teacher
    Route::get('/admin/teachers', [AdminController::class, 'teacherList'])
        ->name('teachers.index');

    // SAVE DATA ✅
    Route::post('/admin/teachers', [AdminController::class, 'storeTeacherList'])
        ->name('teachers.store');

    //UPDATE TEACHER
    Route::put('/admin/teachers/{user}', [AdminController::class, 'updateTeacherList'])
        ->name('teacher.update');

    // Delete TEACHER
    Route::delete('/admin/teachers/{user}', [AdminController::class, 'destroyTeacherList'])
        ->name('teacher.destroy');


    // Display page
    Route::get('/admin/subjects', [AdminController::class, 'subjects'])
        ->name('subjects.index');
    // Store
    Route::post('/admin/subjects', [AdminController::class, 'storeSubject'])
        ->name('subjects.store');

    // Update
    Route::put('/admin/subjects/{id}', [AdminController::class, 'updateSubject'])
        ->name('subjects.update');
    // Delete
    Route::delete('/admin/subjects/{id}', [AdminController::class, 'destroySubject'])
        ->name('subjects.destroy');


    // Display page both semeseter and academic
    Route::get('/admin/academicsemesters', [AdminController::class, 'academicsemesters'])
        ->name('academicsemesters.index');
    // Store Academic
    Route::post('/admin/academicsemesters/academic', [AdminController::class, 'storeAcademic'])
        ->name('academic.store');

    // CHANGE ACADEMIC Open
    Route::put('/admin/academicsemestersacademicrOpen/{id}', [AdminController::class, 'openAcademic'])
        ->name('academic.change_open');
    // CHANGE ACADEMIC CLOSE
    Route::put('/admin/academicsemesters/academicClose/{id}', [AdminController::class, 'closeAcademic'])
        ->name('academic.close');
    // Store Semester
    Route::post('/admin/academicsemesters/semester', [AdminController::class, 'storeSemester'])
        ->name('semester.store');

    // CHANGE semester Open
    Route::put('/admin/academicsemesters/semesterOpen/{id}', [AdminController::class, 'openSemester'])
        ->name('semester.change_open');
    // CHANGE semester CLOSE
    Route::put('/admin/academicsemesters/semesterClose/{id}', [AdminController::class, 'closeSemester'])
        ->name('semester.close');

    // Display page
    Route::get('/admin/questionnaire', [AdminController::class, 'questionnaire'])
        ->name('questionnaire.index');

    // Toggle active/inactive
    Route::patch('/admin/questionnaire/{question}/toggle', [AdminController::class, 'toggleQuestion'])
        ->name('questionnaire.toggle');
    // INSERT QUESTION 
    Route::post('/admin/questionnaire/question/', [AdminController::class, 'storequestionnaire'])
        ->name('questionnaire.store');

    // INSERT QUESTION CATEGORY
    Route::post('/admin/questionnaire/category/', [AdminController::class, 'storecategory'])
        ->name('category.store');

    // Delete Category
    Route::delete('/admin/questionnaire/{id}', [AdminController::class, 'destroycategory'])
        ->name('category.destroy');

    // Display subject assignment
    Route::get('/admin/teacherassignment', [AdminController::class, 'teacherassignment'])
        ->name('teacherassignment.index');


    // SAVE DATA TEACHER ASSIGNMENT ✅
    Route::post('/admin/teacherassignment', [AdminController::class, 'storeteacherassignment'])
        ->name('teacherassignment.store');

    // Delete
    Route::delete('/admin/teacherassignment/{id}', [AdminController::class, 'destroyteacherassignment'])
        ->name('teacherassignment.destroy');


        // Display reports teacher
    Route::get('/admin/reports', [AdminController::class, 'teacherReport'])
        ->name('reports.index');








});

// =====================================================
// TEACHER ROUTES
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('/teacher/home', function (Request $request) {
        return view('TeacherSide.home', [
            'user' => $request->user(),
        ]);
    })->name('TeacherSide.home');
});

// =====================================================
// PROFILE ROUTES (Shared)
// =====================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__ . '/auth.php';
