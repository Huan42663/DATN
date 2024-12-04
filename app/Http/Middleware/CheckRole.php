<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login'); // Nếu chưa đăng nhập, chuyển hướng đến trang đăng nhập
        }

        // Kiểm tra nếu người dùng là admin
        if (Auth::user()->role == 'admin') {
            return redirect()->route('Administration.Home'); // Nếu là admin, chuyển hướng đến trang admin
        }

        // Nếu không phải admin và đã đăng nhập, tiếp tục đến yêu cầu tiếp theo
        return $next($request);
    }
}
