@extends('client.master')

@section('title', 'đặt lại mật khẩu')

@section('content')

<style>
    .form-container {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .form-container h2 {
        font-size: 24px;
        color: #333;
        margin-bottom: 10px;
    }

    .form-container p {
        font-size: 14px;
        color: #666;
    }

    .form-container label {
        display: block;
        font-size: 14px;
        color: #333;
        margin-top: 15px;
        text-align: left;
    }

    .form-container input[type="email"],
    .form-container input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-container button {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .form-container button:hover {
        background-color: #0056b3;
    }

    .back-link {
        display: block;
        margin-top: 15px;
        color: #007bff;
        text-decoration: none;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .notification {
        max-width: 400px;
        margin: 20px auto;
        padding: 15px;
        border-radius: 4px;
        text-align: center;
    }

    .notification.success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .notification.error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
</style>

<div class="form-container">
    <h2>Đặt lại mật khẩu</h2>
    <p>Nhập email và mật khẩu mới của bạn.</p>
    <form action="{{ route('reset-password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="example@mail.com" required>
        </div>
        <div>
        <label for="password">Mật khẩu mới:</label>
        <input type="password" name="password" required>
        </div>
        <div>
        <label for="password_confirmation">Xác nhận mật khẩu:</label>
        <input type="password" name="password_confirmation" required>
        </div>
        <div></div>
        <button type="submit">Đặt lại mật khẩu</button>
        </div>
    </form>

</div>

<!-- Thông báo thành công -->
@if(session('message'))
<div class="notification success">{{ session('message') }}</div>
@endif

<!-- Thông báo lỗi -->
@if($errors->any())
<div class="notification error">{{ $errors->first() }}</div>
@endif

@endsection