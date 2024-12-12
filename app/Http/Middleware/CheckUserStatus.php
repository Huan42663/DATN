<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Kiểm tra nếu session đã hết hạn
            if (!$request->session()->has('last_active')) {
                $request->session()->put('last_active', now());
            }

            // Cập nhật lại trạng thái nếu người dùng không hoạt động quá 30 phút
            if (now()->diffInMinutes($request->session()->get('last_active')) > 30) {
                $user->update(['status' => 1]); // Đặt trạng thái logout
                Auth::logout(); // Đăng xuất người dùng
                return redirect()->route('login')->withErrors('Session expired. Please log in again.');
            }

            // Cập nhật thời gian hoạt động cuối
            $request->session()->put('last_active', now());
        }

        return $next($request);
    }
}
