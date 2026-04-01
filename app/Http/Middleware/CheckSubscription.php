<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class CheckSubscription
{
    public function handle($request, Closure $next)
    {
        if (!isPremium()) {
            return redirect('/subscription')->with('error', 'Upgrade to premium to access this content');
        }

        return $next($request);
    }
}
