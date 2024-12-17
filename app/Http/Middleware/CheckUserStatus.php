<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        // if (Auth::check()) {
        //     $user = Auth::user();

        //     // Kiểm tra nếu session đã hết hạn
        //     if (!$request->session()->has('last_active')) {
        //         $request->session()->put('last_active', now());
        //     }

        //     // Kiểm tra nếu thời gian không hoạt động quá 1 phút
        //     if (now()->diffInMinutes($request->session()->get('last_active')) > 1) {
        //         // Cập nhật trạng thái người dùng trước khi logout
        //         $user->update(['status' => 1]);  // Cập nhật trạng thái "đã đăng xuất" trước khi logout

        //         // Log thông tin người dùng đã tự động logout
        //         Log::info('User ' . $user->id . ' logged out due to inactivity.');

        //         // Đăng xuất người dùng và xóa session
        //         Auth::logout();
        //         $request->session()->invalidate();
        //         $request->session()->regenerateToken();

        //         // Chuyển hướng người dùng đến trang đăng nhập với thông báo
        //         return redirect()->route('login')->withErrors('Session expired due to inactivity. Please log in again.');
        //     }

        //     // Cập nhật thời gian hoạt động cuối cùng nếu người dùng vẫn còn hoạt động
        //     $request->session()->put('last_active', now());
        // }

        // // Tiếp tục xử lý request nếu không có vấn đề gì
        // return $next($request);
    }
}
