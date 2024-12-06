<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ForgotPasswordController extends Controller
{
    // Hiển thị form yêu cầu quên mật khẩu
    public function showForgotPasswordForm()
    {
        return view('Client.forgot-password');
    }

    // Gửi link đặt lại mật khẩu
    public function sendResetLink(Request $request)
{
    // Validate email
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ], [
        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Email không hợp lệ.',
        'email.exists' => 'Email không tồn tại trong hệ thống.'
    ]);

    $email = $request->email;

    // Kiểm tra email đã tồn tại trong bảng `password_reset_tokens`
    $existingToken = DB::table('password_reset_tokens')->where('email', $email)->first();

    if ($existingToken) {
        // Kiểm tra token có hết hạn hay chưa (15 phút)
        $tokenExpiry = Carbon::parse($existingToken->created_at)->addMinutes(15);

        if ($tokenExpiry->isFuture()) {
            // Nếu token còn hiệu lực, thông báo kiểm tra email
            return back()->with('message', 'Bạn đã yêu cầu đặt lại mật khẩu rồi. Vui lòng kiểm tra email của bạn.');
        } else {
            // Nếu token hết hạn, cập nhật token và thời gian
            $token = Str::random(60);
            DB::table('password_reset_tokens')->where('email', $email)->update([
                'token' => $token,
                'created_at' => now()
            ]);
        }
    } else {
        // Nếu email chưa có token, tạo token mới
        $token = Str::random(60);
        DB::table('password_reset_tokens')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);
    }

    // Gửi email đặt lại mật khẩu
    Mail::send('emails.password-reset', ['token' => $token], function ($message) use ($email) {
        $message->to($email);
        $message->subject('Đặt lại mật khẩu');
    });

    return back()->with('message', 'Đã gửi link đặt lại mật khẩu tới email của bạn!');
}

    // Hiển thị form đặt lại mật khẩu
    public function showResetPasswordForm($token)
    {
        return view('Client.reset-password', ['token' => $token]);
    }

    // Đặt lại mật khẩu mới
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required'
        ], [
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.exists' => 'Email không tồn tại trong hệ thống.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.string' => 'Mật khẩu phải là chuỗi.',
            'password.min' => 'Mật khẩu phải có ít nhất :min ký tự.',
            'password.confirmed' => 'Mật khẩu không khớp.',
            'token.required' => 'Token là bắt buộc.',
        ]);

        // Kiểm tra token
        $record = DB::table('password_reset_tokens')->where([
            'email' => $request->email,
            'token' => $request->token,
        ])->first();

        if (!$record) {
            return back()->withErrors(['token' => 'Email không hợp lệ!']);
        }

        // Cập nhật mật khẩu mới
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Xóa token sau khi đặt lại mật khẩu
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Đặt lại mật khẩu thành công!. Vui lòng đăng nhập bằng mật khẩu mới');
    }
}
