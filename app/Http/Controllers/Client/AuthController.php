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
use Illuminate\Support\Facades\Mail;

use App\Mail\RegisteredMail;
use Carbon\Carbon;
use Illuminate\Support\Str;



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
            'password' => 'required|min:5',
        ]);

        // Lấy thông tin người dùng qua email
        $user = \App\Models\User::where('email', $request->email)->first();

        if (!$user) {
            // Tài khoản không tồn tại
            return back()->withErrors([
                'email' => 'The account does not exist.',
            ])->withInput();
        }
        if (!$user->email_verified_at) {
            return back()->withErrors([
                'email' => 'Vui lòng kiểm tra email của bạn để kích hoạt tài khoản!',
            ])->withInput();
        }
        // Kiểm tra nếu người dùng đang đăng nhập
        if ($user->status == 2) {
            return back()->withErrors([
                'email' => 'This account is already logged in from another session.',
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
            'email' => 'Invalid email or password.',
        ])->withInput();
    }

    // public function register(Request $request)
    // {
    //     // Xác thực dữ liệu đầu vào
    //     $request->validate([
    //         'fullName' => [
    //             'required',
    //             'string',
    //             'max:255',
    //             'regex:/^[\p{L}0-9\s]+$/u', // Chỉ cho phép chữ cái, số và khoảng trắng
    //         ],
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:6|confirmed',
    //         'phone' => 'required|string|max:15|unique:users,phone',
    //     ], [
    //         'fullName.regex' => 'Full name chỉ được dùng chữ cái và số',
    //     ]);

    //     try {
    //         // Tạo tài khoản người dùng
    //         $user = User::create([
    //             'fullName' => $request->fullName,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //             'phone' => $request->phone,
    //             'role' => 'guest', // Role mặc định
    //         ]);

    //         // Tạo giỏ hàng
    //         Cart::create([
    //             'user_id' => $user->user_id,
    //         ]);

    //         return redirect()->route('Client.account.showLoginForm')->with('success', 'Account created successfully. Please log in.');
    //     } catch (\Exception $e) {
    //         // Log lỗi và hiển thị thông báo
    //         Log::error('Registration Error: ' . $e->getMessage());
    //         return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    //     }
    // }
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
            // Tạo một bản ghi tạm thời với thông tin người dùng (chưa tạo tài khoản)
            $user = User::create([
                'fullName' => $request->fullName,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'email_verified_at' => null, 
            ]);
            $verifyUrl = route('verifyEmail', ['email' => $user->email]);
            Mail::to($user->email)->send(new RegisteredMail($user, $verifyUrl));
            return redirect()->route('Client.account.showLoginForm')->with('success', 'Vui lòng kiểm tra email để xác nhận.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Có lỗi xảy ra: ' . $e->getMessage()]);
        }
    }
    public function verify(Request $request, $email)
    {
        // Tìm người dùng bằng email
        $user = User::where('email', $email)->first();
        if (!$user) {
            return redirect()->route('home')->with('error', 'Tài khoản không tồn tại.');
        }
        if (!$user->email_verified_at) {
            
            $user->email_verified_at = now();
            $user->save();
        }
         // Tạo giỏ hàng
            Cart::create([
                'user_id' => $user->user_id,
            ]);
        return redirect()->route('Client.account.showLoginForm')->with('success', 'Tài khoản đã được xác nhận. Bạn có thể đăng nhập.');
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
