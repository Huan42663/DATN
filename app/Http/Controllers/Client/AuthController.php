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
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
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

            return redirect()->route('Client.account.showLoginForm')->with('success', 'Account created successfully. Please log in.');
        } catch (\Exception $e) {
            // Log lỗi và hiển thị thông báo
            Log::error('Registration Error: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        // Chuyển hướng sau khi đăng ký thành công
        return redirect()->route('Client.account.showLoginForm')->with('success', 'Account created successfully.');
    }

    // public function verifyEmail($token){
    //     $user = User::where('email_verified_token', $token)->first();
    //     if($user){
    //         $user->email_verified_at = now();
    //         $user->email_verified_token = null;
    //         $user->save();
    //         return redirect()->route('Client.account.showLoginForm')->with('success', 'Email verified successfully.');
    //     }
    //     return redirect()->route('login')->with('error', 'Invalid or expired token.');
    // }
    // public function verifyPassword($token){
    //     $user = User::where('password_reset_token', $token)->first();
    //     if($user){
    //         return view('auth.passwords.reset', compact('user'));
    //     }
    //     return redirect()->route('login')->with('error', 'Invalid or expired token.');
    // }
    public function update(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = auth()->user();

        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'phone' => 'nullable|numeric',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cập nhật thông tin tài khoản
        $user->fullName = $request->fullName;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->hasFile('avatar')) {
            $path = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $path;
        }

        $user->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }
}
