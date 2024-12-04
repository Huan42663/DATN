
<div class="login-block md:py-20 py-10">
    <div class="container">
        <div class="content-main flex gap-y-8 max-md:flex-col">
            <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                <div class="heading4">Login</div>
                @if(session('success'))
                    <div id="alert-success" class="alert alert-success fixed top-5 right-5 bg-green-500 text-white p-4 rounded shadow">
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
                               placeholder="Password *" required />
                               @error('password')
                               <span class="text-danger">{{ $message }}</span>
                               @enderror
                    </div>
                    <div class="block-button md:mt-7 mt-4"><button class="button-main">Login</button></div>
                </form>
            </div>
            <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                <div class="text-content">
                    <div class="heading4">New Customer</div>
                    <div class="mt-2 text-secondary">Be part of our growing family of new customers! Join us today
                        and unlock a world of exclusive benefits, offers, and personalized experiences.</div>
                    <div class="block-button md:mt-7 mt-4"><a class="button-main" href="{{ route('Client.account.showRegisterForm') }}">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
