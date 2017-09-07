<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Get the currently authenticated user
        $current_user = Auth::user();
        if(!$current_user->admin){
            Session::flash('info', 'U can not access this page!');
            return redirect()->back();
        }
        return $next($request);
    }
}
