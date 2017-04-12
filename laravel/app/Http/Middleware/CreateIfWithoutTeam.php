<?php

namespace Wagg\Yondel\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CreateIfWithoutTeam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (0 === Auth::user()->teams->count()) {
            return redirect()->route('team.create');
        }

        return $next($request);
    }
}
