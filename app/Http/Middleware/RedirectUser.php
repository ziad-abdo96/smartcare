<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectUser
{

    public function handle(Request $request, Closure $next)
    {

        $user = null;

        if ($request->is('api/*')) {

            $user = Auth::guard('sanctum')->user();

        } else {

            $user = Auth::user();
        }

        if (! $user) {
            if ($request->is('api/*')) {

                return response()->json(['message' => 'Unauthorized'], 401);
            } else {

                return redirect()->route('login');
            }
        }

        if ($user->type == 'doctor') {
            if ($request->is('api/*')) {
                return response()->json(['redirect' => route('doctor.profile')]);
            } else {
                return redirect()->route('doctor.profile');
            }
        }

        if ($user->type == 'nurse') {
            if ($request->is('api/*')) {
                return response()->json(['redirect' => route('nurse.profile')]);
            } else {
                return redirect()->route('nurse.profile');
            }
        }

        if ($user->type == 'admin') {
            if ($request->is('api/*')) {
                return response()->json(['redirect' => route('dashboard.doctors.index')]);
            } else {
                return redirect()->route('dashboard.doctors.index');
            }
        }

        return $next($request);
    }
}
