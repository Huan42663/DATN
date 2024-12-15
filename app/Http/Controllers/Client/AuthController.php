<?php

namespace App\Http\Controllers\Client;

use App\Events\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Lấy thông tin người dùng đang đăng nhập
        $userId = auth()->user()->user_id;
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        // dd($orders);
        return view('client.components.account', ['orders' => $orders], ['user' => $user]);
    }

    // Cập nhật thông tin tài khoản
    // public function update(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email,' . Auth::id(),
    //     ]);

    //     $user = Auth::user();
    //     // $user->update($request->only('name', 'email'));

    //     return redirect()->back()->with('success', 'Account updated successfully.');
    // }

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
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            // Cập nhật trạng thái thành 1 (đã đăng xuất)
            $user->status = 1;
            $user->save();
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // Điều hướng đến trang login
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
            'password' => 'required|min:6',
        ]);

        // Lấy thông tin người dùng qua email
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            // Tài khoản không tồn tại
            return back()->withErrors([
                'email' => __('auth.account_not_exist'),
            ])->withInput();
        }

        // Kiểm tra nếu người dùng đang đăng nhập
        if ($user->status == 2) {
            return back()->withErrors([
                'email' => __('auth.already_logged_in'),
            ])->withInput();
        }

        // Thực hiện đăng nhập
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Cập nhật trạng thái thành 2 (đang đăng nhập)
            $user->status = 2;
            $user->save();

            return redirect()->intended('/'); // Điều hướng đến trang chủ hoặc trang trước đó
        }

        return back()->withErrors([
            'email' => __('auth.invalid_credentials'),
        ])->withInput();
    }

    public function register(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'fullName' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}0-9\s]+$/u', // Chỉ cho phép chữ cái, số và khoảng trắng
            ],
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:15|unique:users,phone',
        ], [
            'fullName.regex' => 'Full name chỉ được dùng chữ cái và số',
        ]);

        try {
            // Tạo tài khoản người dùng
            $user = User::create([
                'fullName' => $request->fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'role' => 'guest', // Role mặc định
            ]);

            // Tạo giỏ hàng
            Cart::create([
                'user_id' => $user->user_id,
            ]);

            return redirect()->route('Client.account.showLoginForm')->with('success', 'Đăng kí thành công ! Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            // Log lỗi và hiển thị thông báo
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        // Validate các trường thông tin người dùng
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'phone' => 'nullable|numeric',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cập nhật thông tin tài khoản (Full Name, Email, Phone)
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->phone = $request->phone;

        // Cập nhật Avatar nếu có
        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        // Kiểm tra mật khẩu mới và mật khẩu cũ
        if ($request->filled('current_password') && $request->filled('new_password')) {
            // Kiểm tra mật khẩu cũ
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Mật khẩu cũ không chính xác.']);
            }

            // Kiểm tra mật khẩu mới
            $request->validate([
                'new_password' => 'required|min:8|confirmed',
            ]);

            // Cập nhật mật khẩu mới
            $user->password = Hash::make($request->new_password);

            session()->flash('password_success', 'Mật khẩu của bạn đã được thay đổi thành công!');

        }

        // Lưu thông tin đã cập nhật
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật tài khoản thành công');
    }
}
