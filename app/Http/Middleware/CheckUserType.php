<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
        // if($user->type == 'doctor') {
        //     return redirect()->route('doctor.profile');
        // } 
        // if($user->type == 'nurse') {
        //     return redirect()->route('nusrse')
        // }
        
        $user = $request->user();

        if(!$user) {
            return abort(401);
        }
        if(!in_array($user->type, $types)){
            return abort(403);
        }  

        return $next($request);
    }
}
