<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle(Request $request, Closure $next, ...$guards)
    {

        $guards = empty($guards) ? ['web'] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();

                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Already authenticated',
                        'user'    => $user,
                    ], 200);
                }

                return match ($user->type) {
                    'doctor' => redirect()->route('doctor.profile'),
                    'nurse' => redirect()->route('nurse.profile'),
                    'admin' => redirect()->route('dashboard.doctors.index'),
                    default => redirect('/home'),
                };
            }
        }

        return $next($request);
    }
}
