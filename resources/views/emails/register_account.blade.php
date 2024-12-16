<p>Xin chào:  <b> {{ $user->fullName }}</b>,</p>
<p>Cảm ơn bạn đã đăng ký tài khoản tại JStore! Để xác nhận tài khoản, vui lòng kiểm tra lại đúng thông tin của bạn:</p>
<div class="form-group" style="margin-bottom: 15px;">
    <label for="name" style="display: block;font-weight: bold;margin-bottom: 5px;color: #555;">Họ
        và tên:</label>
    <input type="text"
        style="width: 100%;padding: 8px;box-sizing: border-box;border: 1px solid #ccc;border-radius: 5px;background-color: #e9e9e9;"
        id="name" disabled name="name" value="{{ $user->fullName }}">
</div>
<div class="form-group" style="margin-bottom: 15px;">
    <label for="email" style="display: block;font-weight: bold;margin-bottom: 5px;color: #555;">Email:</label>
    <input type="text"
        style="width: 100%;padding: 8px;box-sizing: border-box;border: 1px solid #ccc;border-radius: 5px;background-color: #e9e9e9;"
        id="email" disabled name="email" value="{{ $user->email }}">
</div>
<div class="form-group" style="margin-bottom: 15px;">
    <label for="password" style="display: block;font-weight: bold;margin-bottom: 5px;color: #555;">Số điện thoạithoại:</label>
    <input type="text"
        style="width: 100%;padding: 8px;box-sizing: border-box;border: 1px solid #ccc;border-radius: 5px;background-color: #e9e9e9;"
        id="phone" disabled name="phone" value="{{ $user->phone }}">
</div>
<input type="hidden" name="name" value="{{ $user->fullName }}">
<input type="hidden" name="email" value="{{ $user->email }}">
<input type="hidden" name="phone" value="{{ $user->phone }}">
<p>Nếu bạn là người đăng ký, Vui lòng nhấp vào xác nhận tài khoản dưới đây! </p>
<p><a href="{{ $verifyUrl }}" style="color: #ffffff; background-color: #4CAF50; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
        Xác Nhận Tài Khoản
    </a></p>

<p><b>Nếu bạn không đăng ký tài khoản này, vui lòng bỏ qua email này.</b></p>
<p><b>Trân trọng !, JStore</b></p>