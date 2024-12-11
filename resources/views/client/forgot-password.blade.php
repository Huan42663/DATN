@extends('client.master')

@section('title', 'quên mật khẩu')

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
}

.form-container input[type="email"] {
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
    <h2>Quên mật khẩu?</h2>
    <p>Nhập địa chỉ email của bạn để nhận link đặt lại mật khẩu.</p>
    <form action="{{ route('forgot-password.send') }}" method="POST">
        @csrf
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="example@mail.com" required>
        
        <button type="submit">Gửi link đặt lại mật khẩu</button>
    </form>
    <a href="{{ route('login') }}" class="back-link">Quay lại đăng nhập</a>
</div>

@if(session('message'))
    <div class="notification success">{{ session('message') }}</div>
@endif

@if($errors->any())
    <div class="notification error">{{ $errors->first() }}</div>
@endif
@endsection
