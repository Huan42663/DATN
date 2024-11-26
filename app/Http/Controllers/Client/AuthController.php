<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('client.account.profile', ['user' => Auth::user()]);
    }

    // Cập nhật thông tin tài khoản
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        // $user->update($request->only('name', 'email'));

        return redirect()->back()->with('success', 'Account updated successfully.');
    }

    // Hiển thị form quên mật khẩu
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        // Thực hiện logic reset mật khẩu (gửi email, token...)
        return redirect()->back()->with('status', 'Password reset link sent to your email.');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Đăng xuất
    public function logout()
    {
        Auth::logout();
        return redirect()->route('Client.account.showLoginForm');
    }

    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Xử lý đăng ký
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            return redirect()->intended('/'); // Điều hướng đến trang chủ hoặc trang trước đó
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:15|unique:users,phone',
        ]);

        // Tạo tài khoản người dùng
        User::create([
            'fullName' => $request->fullName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => 'guest', // Role mặc định
        ]);

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('Client.account.showLoginForm')->with('success', 'Account created successfully.');
    }

}
