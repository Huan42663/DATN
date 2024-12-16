<?php


return [
    'required' => ':attribute không được để trống.',
    'email' => ':attribute phải là một địa chỉ email hợp lệ.',
    'unique' => ':attribute đã được sử dụng.',
    'confirmed' => ':attribute xác nhận không khớp.',
    'min' => [
        'numeric' => ':attribute phải có giá trị ít nhất là :min.',
        'file' => ':attribute phải có dung lượng ít nhất :min kilobytes.',
        'string' => ':attribute phải có ít nhất :min ký tự.',
        'array' => ':attribute phải có ít nhất :min phần tử.',
    ],
    'max' => [
        'numeric' => ':attribute không được vượt quá :max.',
        'file' => ':attribute không được lớn hơn :max kilobytes.',
        'string' => ':attribute không được vượt quá :max ký tự.',
        'array' => ':attribute không được có nhiều hơn :max phần tử.',
    ],
    'regex' => ':attribute không hợp lệ.',
    'attributes' => [
        'fullName' => 'Họ và tên',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        'phone' => 'Số điện thoại',
    ],
];
