<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

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

        $validator = Validator::make(
            $request->all(),
            [
                'fullname' => 'required|min:8|regex:/^[a-zA-Z0-9]+$/',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required|unique:users,phone',
            ],
            [
                'fullname.required' => 'họ tên không được để trống',
                'fullname.min' => 'họ tên tối thiểu từ 8 ký tự',
                'fullname.regex' => 'họ tên không được chứa ký tự đặc biệt',
                'email.required' => 'email không được để trống',
                'email.email' => 'email không đúng định dạng',
                'email.unique' => 'email đã được sử dụng',
                'password.required' => 'mật khẩu không được để trống',
                'password.min' => 'mật khẩu tối thiểu từ 8 ký tự',
                'password.confirmed' => 'mật khẩu không khớp',
                'password_confirmation.required' => 'vui lòng nhập lại mật khẩu',
                'phone.required' => 'số điện thoại không được để trống',
                'phone.unique' => 'số điện thoại đã được sử dụng',
            ]
        );
        $data = $request->except(['password', 'password_confirmation']);
        $data['password'] = Hash::make($request['pasword']);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        } else {
            $user = User::create($data);
            return response()->json(['message' => 'đăng ký thành công', 'data' => $user], Response::HTTP_CREATED);
        }
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
        $listUser = User::query()->where('user_id', "!=", $id)->get();
        if (empty($user[0])) {
            return response()->json(['errors' => "không tìm thấy user"], Response::HTTP_BAD_REQUEST);
        } else {
            foreach ($listUser as $value) {
                if ($value->email == $request->email) {
                    return response()->json(['errors' => "email bị trùng"], Response::HTTP_BAD_REQUEST);
                } elseif ($value->phone == $request->phone) {
                    return response()->json(['errors' => "số điện thoại bị trùng"], Response::HTTP_BAD_REQUEST);
                }
            }
            $validator = Validator::make(
                $request->all(),
                [
                    'fullname' => 'required|min:8|regex:/^[a-zA-Z0-9]+$/',
                    'email' => 'required|email|unique:users,email',
                    'phone' => 'required|unique:users,phone',
                ],
                [
                    'fullname.required' => 'họ tên không được để trống',
                    'fullname.min' => 'họ tên tối thiểu từ 8 ký tự',
                    'fullname.regex' => 'họ tên không được chứa ký tự đặc biệt',
                    'email.required' => 'email không được để trống',
                    'email.email' => 'email không đúng định dạng',
                    'email.unique' => 'email đã được sử dụng',
                    'phone.required' => 'số điện thoại không được để trống',
                    'phone.unique' => 'số điện thoại đã được sử dụng',
                ]
            );
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            } else {
                User::query()->where("user_id", $id)->update($request->all());
                return response()->json(
                    [
                        'message' => 'chỉnh sửa thành công',
                        'data' => User::query()->where("user_id", $id)->get()
                    ],
                    Response::HTTP_OK
                );
            }
        }
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
