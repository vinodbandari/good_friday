<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class admin
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->is_admin == 1) {
             return $next($request);
        }

        return redirect()->back()->with('errors','You have not admin access');
    }
}