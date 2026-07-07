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
});

// =====================================================
// ADMIN ROUTES
// =====================================================
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin/home', function (Request $request) {
        return view('AdminSide.home', [
            'user' => $request->user(),
        ]);
    })->name('AdminSide.home');


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


    Route::get('/admin/students', [AdminController::class, 'studentList'])
        ->name('students.index');

    // SAVE DATA ✅
    Route::post('/admin/students', [AdminController::class, 'storeStudentList'])
        ->name('students.store');


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
