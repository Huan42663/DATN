<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
    // Kiểm tra nếu người dùng đã đăng nhập và có vai trò admin hoặc manager
    if (Auth::check() && (Auth::user()->role == 'admin' || Auth::user()->role == 'manager')) {
        return $next($request); // Cho phép truy cập
    }

        // Nếu không phải admin, chuyển hướng đến trang chủ hoặc trang khác
        return redirect()->route('Client.Home'); // Hoặc trang login
    }
}
