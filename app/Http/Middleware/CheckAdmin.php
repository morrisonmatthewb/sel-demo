<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (!\App\Helpers\FormApi::logged_in_admin()) {
            // Return a 403 Forbidden response if the user is not an admin
            return Response::make('Forbidden', 403);
        }

        return $next($request);
    }
}

