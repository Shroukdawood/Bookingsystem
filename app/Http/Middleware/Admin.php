<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
        use Notifiable;
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->isAdmin) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
