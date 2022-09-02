<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user()) {
            // The user is authorized and an administrator
            if(auth()->user()->is_admin == 1){
                return $next($request);
            }
        } else {
            // User is not authorized == Unauthenticated
            if($request->wantsJson()) {
                return response()->json(['error' => true, 'message' => 'User is not authorized'], 201);
            }

            return redirect()->route('site.index')->with('error',"You don't have admin access.");
        }

        // The user is authorized but not an administrator
        if($request->wantsJson()) {
            return response()->json(['error' => true, 'message' => 'something went wrong!'], 201);
        }

        return redirect()->route('site.index')->with('error',"You don't have admin access.");
    }
}
