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
    public function login(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|string|email',
                'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        // Kiểm tra thông tin đăng nhập
        $credentials = $request->only('email', 'password');
        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Thông tin đăng nhập không chính xác.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        // Lấy thông tin người dùng và tạo token
        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'Đăng nhập thành công!',
            'user' => $user,
            'token' => $token,
        ], Response::HTTP_OK);
    }
    public function register(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $validator = Validator::make(
            $request->all(),
            [
                'fullname' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users,email',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'nullable|string|max:20|unique:users,phone', // Có thể để trống
            ]
        );

        // Tạo người dùng mới

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone, // Có thể để trống
            'avatar' => null, // Không cần nhập, có thể để null
            'status' => 1, // Giá trị mặc định
            'role' => 'guest',
        ]);

        return response()->json([
            'message' => 'Đăng ký thành công!',
            'user' => $user,
        ], Response::HTTP_CREATED);
    }
}
