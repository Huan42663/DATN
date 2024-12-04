<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (!Auth::check()) {
            return route('Client.account.showLoginForm'); // Điều hướng đến form login
        }

        // Nếu đã đăng nhập, kiểm tra quyền admin
        if (Auth::user()->role == 'admin') {
            return route('Administration.Home'); // Điều hướng đến trang admin
        }
    }
}
