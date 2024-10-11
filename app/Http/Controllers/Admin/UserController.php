<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return response()->json(
            [
                'message' => 'danh sách người dùng',
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'fullname' => 'required|min:8|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'require|same:password',
            'phone' => 'required|regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))([0-9]{7})$/',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'fullname.required' => 'họ tên không được để trống',
            'fullname.min' => 'họ tên tối thiểu từ 8 ký tự',
            'fullname.regex' => 'họ tên không được chứa ký tự đặc biệt',
            'email.required' => 'email không được để trống',
            'email.email' => 'email không đúng định dạng',
            'password.required' => 'mật khẩu không được để trống',
            'password.min' => 'mật khẩu tối thiểu từ 8 ký tự',
            'password_confirmation.required' => 'xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'mật khẩu phải trùng với xác nhận mật khẩu',
            'phone.required' => 'số điện thoại không được để trống',
            'phone.regex' => 'số điện thoại không đúng',
            'avatar.image' => 'ảnh không đúng định dạng',
            'avatar.mimes' => 'yêu cầu ảnh có đuôi jpeg,png,jpg,gif',
            'avatar.max' => 'kích thước tối đa của ảnh là 2MB'
        ]);
        $data['password'] = Hash::make($data['pasword']) ;
        $user = User::create($data);
        return response()->json(['message' => 'đăng ký thành công', 'data' => $user], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = User::query()->where('user_id', $id)->get();
            return response()->json(
                [
                    'message' => 'chi tiết người dùng',
                    'data' => $data
                ]
            );
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['error' => "Không tìm thấy người dùng"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::query()->where('user_id', $id)->get();
        $data = $request->validate([
            'fullname' => 'required|min:8|regex:/^[a-zA-Z0-9]+$/',
            'email' => 'required|email',
            'phone' => 'required|regex:/^(0|\+84)(\s|\.)?((3[2-9])|(5[689])|(7[06-9])|(8[1-689])|(9[0-46-9]))([0-9]{7})$/',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'fullname.required' => 'họ tên không được để trống',
            'fullname.min' => 'họ tên tối thiểu từ 8 ký tự',
            'fullname.regex' => 'họ tên không được chứa ký tự đặc biệt',
            'email.required' => 'email không được để trống',
            'email.email' => 'email không đúng định dạng',
            'phone.required' => 'số điện thoại không được để trống',
            'phone.regex' => 'số điện thoại không đúng',
            'avatar.image' => 'ảnh không đúng định dạng',
            'avatar.mimes' => 'yêu cầu ảnh có đuôi jpeg,png,jpg,gif',
            'avatar.max' => 'kích thước tối đa của ảnh là 2MB'
        ]);
        $user->update($data);
        return response()->json(['message' => 'cập nhật thành công', 'data' => $user], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = User::query()->where('user_id', $id)->get();
            $data->delete();
            return response()->json(
                [
                    'message' => 'Xóa người dùng thành công',
                    Response::HTTP_OK
                ]
            );
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['error' => "Không tìm thấy người dùng"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }
}
