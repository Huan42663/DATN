<div class="login-block md:py-20 py-10">
    <div class="container">
        <div class="content-main flex gap-y-8 max-md:flex-col">
            <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                <div class="heading4">Đăng Nhập</div>

                @if(session('success'))
                <div id="success-alert" class="alert alert-success alert-dismissible">
                    <h8><i class="icon fa fa-check"></i> Xong!</h8>
                    {{ session('success') }}
                </div>
                @endif
                <form class="md:mt-7 mt-4" action="{{ route('login') }}" method="POST">
                    @csrf

                    <div class="email">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg"
                            id="email" name="email" type="email"
                            value="{{ old('email') }}"
                            placeholder="Email *" required />
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="pass mt-5">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg"
                            id="password" name="password" type="password"
                            placeholder="Mật khẩu *" required />
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="block-button md:mt-7 mt-4" style="display: flex; align-items: center; justify-content: space-between; gap: 10px;">
                        <button class="button-main">Đăng Nhập</button>
                        <a href="{{ route('password.request') }}" class=" button-main px-4 py-2" style="color: #ffffff; text-decoration: none; border-radius: 5px; font-weight: bold;">Quên mật khẩu?</a>

                    </div>

                </form>
            </div>
            <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                <div class="text-content">
                    <div class="heading4">Tạo tài khoản mới</div>
                    <div class="block-button md:mt-7 mt-4"><a class="button-main" href="{{ route('Client.account.showRegisterForm') }}">Đăng Kí</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    // Tự động ẩn thông báo sau 5 giây (5000ms)
    setTimeout(function() {
        var alert = document.getElementById('success-alert');
        if (alert) {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = 0;
            setTimeout(() => alert.remove(), 500); // Xóa phần tử khỏi DOM sau khi ẩn
        }
    }, 5000); // Thời gian hiển thị: 5000ms = 5 giây
</script>
