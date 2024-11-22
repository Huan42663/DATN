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
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('admin.users.create');
    }
    public function store(Request $request)
    {


        $request->validate(
            [
                'fullName' => 'required|min:8',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
                'phone' => 'required|unique:users,phone',
            ],
            [
                'fullName.required' => 'họ tên không được để trống',
                'fullName.min' => 'họ tên tối thiểu từ 8 ký tự',
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

        $request->except(['password', 'password_confirmation']);
        $request['password'] = Hash::make($request['password']);
        $request['role'] = "admin";
        User::create($request->all());
        return redirect(route('Administration.users.list'))->with('message', "thêm mới thành công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $check =  User::query()->where('user_id', $id)->get();
        if (empty($check[0])) {
            return redirect()->route('Administration.users.list')->with('error', 'không tìm thấy tài khoản');
        }
        $user = User::query()->where('user_id', $id)->get();
        return view('admin.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $data = User::query()->where('user_id', $user->user_id)->get();
        $listUser = User::query()->where('user_id', "!=", $user->user_id)->get();
        if (empty($data[0])) {
            return redirect()->route('Administration.users.list')->with('error', 'không tìm thấy tài khoản');
        }
        foreach ($listUser as $value) {
            if ($value->email == $request->email) {
                return redirect()->route('Administration.users.list')->with('error', 'email đã bị trùng');
            } elseif ($value->phone == $request->phone) {
                return redirect()->route('Administration.users.list')->with('error', 'số điện thoại bị trùng');
            }
        }
        $request->validate(
            [
                'email' => 'required|email',
                'phone' => 'required',
                'status' => 'required',
            ],
            [
                'email.required' => 'email không được để trống',
                'email.email' => 'email không đúng định dạng',
                'phone.required' => 'số điện thoại không được để trống',
                'status.required' => 'trạng thái không được để trống',
            ]
        );
        // dd($request->all());
        User::query()->where('user_id', $user->user_id)->update($request->only('status', 'email', 'phone'));
        return redirect()->route('Administration.users.list')->with('message', 'cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $check =  User::query()->where('user_id', $user->user_id)->get();
        if (empty($check[0])) {
            return redirect()->route('Administration.users.list')->with('error', 'không tìm thấy tài khoản');
        }
        $data = $user->only('status');
        $data['status'] = 0;
        User::query()->where('user_id', $user->user_id)->update($data);
        return redirect()->route('Administration.users.list')->with('message', 'tài khoản' . $user->fullName . 'đã bị ngừng hoạt động');
    }
}
