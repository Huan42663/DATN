<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($_SESSION['thankyou'])) {
            return $next($request); // Cho phép truy cập
        }
        return redirect()->route('Client.Home'); // Hoặc trang login
    }
}
