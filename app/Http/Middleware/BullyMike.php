<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class BullyMike
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
        if (auth() && auth()->user()->name == "Mike"){
            session()->flash('success','Mike is being bullied');
            return redirect('/');
        }
        return $next($request);
    }
}
