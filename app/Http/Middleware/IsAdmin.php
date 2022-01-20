<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{

    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->roles[0]->name === 'admin') {
            return $next($request);
        }
        abort(403, 'Unauthorized');
    }
}
