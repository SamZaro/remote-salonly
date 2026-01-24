<?php

namespace App\Http\Middleware;

use App\Booking\BookingModuleManager;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BookingModuleEnabled
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! BookingModuleManager::isEnabled()) {
            abort(404);
        }

        return $next($request);
    }
}
