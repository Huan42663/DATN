<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role): Response
    {
            // Kiểm tra nếu chưa đăng nhập hoặc vai trò không phù hợp
            if (!Auth::check() || Auth::user()->role !== $role) {
                return redirect()->route('Client.Home'); // Điều hướng nếu không đúng quyền
            }

            return $next($request);
    }
}
