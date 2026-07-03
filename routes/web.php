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
    Route::put('/infosettings/update',
        [StudentController::class, 'updateInfo'])
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

    // route::get('/Sections', [AdminController::class, 'sections']);
    Route::get('/sections', [AdminController::class, 'sections'])
    ->name('sections.index');

     // SAVE DATA ✅
    Route::post('/sections', [AdminController::class, 'store'])
        ->name('sections.store');
   
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

require __DIR__.'/auth.php';
