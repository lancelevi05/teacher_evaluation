<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // if (! $user || ! in_array($user->userType, $roles, true)) {
        //     abort(403, 'Unauthorized access.');
        // }

         // User is not logged in
        if (! $user) {
            return redirect()->route('login');
        }

        // User doesn't have permission for this route
        if (! in_array($user->userType, $roles, true)) {

            $redirectRoute = match ($user->userType) {
                'Admin' => route('AdminSide.home'),
                'Teacher' => route('TeacherSide.home'),
                'Student' => route('StudentSide.home'),
                default => route('login'),
            };

            return response()->view('errors.unauthorized', [
                'redirectRoute' => $redirectRoute,
            ], 403);
        }

        return $next($request);
    }
}
