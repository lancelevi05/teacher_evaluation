<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\student_info;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'usn' => ['required', 'string', 'max:50', 'unique:users,usn'],
            'lname' => ['required', 'string', 'max:50'],
            'fname' => ['required', 'string', 'max:55'],
            'mname' => ['required', 'string', 'max:55'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'photo' => ['nullable', 'string', 'max:55'],
            'status' => ['nullable', 'string', 'max:55'],
        ], [
            'usn.unique' => 'This USN is already registered.',
        ]);

        $user = DB::transaction(function () use ($request) {
            $user = User::create([
                'usn' => $request->usn,
                'lname' => $request->lname,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'userType' => 'Student',
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => null, // or Pending
                'status' => 'Active', // or Pending
            ]);

            student_info::firstOrCreate([
                'user_id' => $user->id,
                'usn' => $user->usn,
                
            ]);

            return $user;
        });

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('StudentSide.home', absolute: false));
    }
}
