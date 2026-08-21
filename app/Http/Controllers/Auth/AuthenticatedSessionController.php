<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Models\student_info;
use App\Models\Teacher;

use App\Models\auditLog;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login2');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        // Get the authenticated user
        $user = Auth::user();
        

        // ===========================
        // INSERT LOGIN AUDIT LOG HERE
        // ===========================
        auditLog::create([
            'user_id' => $user->id,
            'action' => 'Login',
            'details' => $user->email,
        ]);

        session()->flash('just_logged_in', true);

        // If Student, ensure student_info record exists
        if ($user->userType === 'Student') {

            student_info::firstOrCreate([
                'user_id' => $user->id,
                'usn' => $user->usn,

            ]);

            return redirect()->intended(route('StudentSide.home', absolute: false));
        }

        // If teacher, ensure Teachers record exists
        if ($user->userType === 'Teacher') {

            Teacher::firstOrCreate([
                'user_id' => $user->id,
                'employee_id' => $user->usn,

            ]);


            return redirect()->intended(route('TeacherSide.home', absolute: false));


        }

        // Redirect based on user type
        

        // Redirect based on user type
        if ($user->userType === 'Admin') {
            return redirect()->intended(route('AdminSide.home', absolute: false));

        } elseif ($user->userType === 'Teacher') {
            return redirect()->intended(route('TeacherSide.home', absolute: false));

        } elseif ($user->userType === 'Student') {
            return redirect()->intended(route('StudentSide.home', absolute: false));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        // ============================
        // INSERT LOGOUT AUDIT LOG HERE
        // ============================
        auditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Logout',
            'details' => 'User logged out.',
        ]);

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
