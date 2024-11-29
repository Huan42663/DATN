<div class="register-block md:py-20 py-10">
    <div class="container">
        <div class="content-main flex gap-y-8 max-md:flex-col">
            <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                <div class="heading4">Register</div>
                <form class="md:mt-7 mt-4" method="POST" action="{{ route('register') }}">
                    @csrf
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="fullName">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="fullName" type="text"
                            name="fullName" placeholder="Full Name *" required="">
                    </div>
                    <div class="confirm-pass mt-5">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="email" type="email"
                            name="email" placeholder="Email *" required="">
                    </div>
                    <div class="pass mt-5">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="password" type="password"
                            name="password" placeholder="Password *" required="">
                    </div>
                    <div class="pass mt-5">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="password_confirmation"
                            type="password" name="password_confirmation" placeholder="Confirm Password *"
                            required="">
                    </div>
                    <div class="pass mt-5">
                        <input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="phone" type="text"
                            name="phone" placeholder="Phone *" required="">
                    </div>
                    {{-- <div class="flex items-center mt-5">
                        <div class="block-input">
                            <input type="checkbox" id="remember" name="remember" required="">
                        </div>
                        <label for="remember" class="pl-2 cursor-pointer text-secondary2">
                            I agree to the <a class="text-black hover:underline pl-1" href="#!">Terms of User</a>
                        </label>
                    </div> --}}
                    <div class="block-button md:mt-7 mt-4">
                        <button class="button-main">Register</button>
                    </div>
                </form>
            </div>
            <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                <div class="text-content">
                    <div class="heading4">Already have an account?</div>
                    <div class="mt-2 text-secondary">Welcome back. Sign in to access your personalized experience,
                        saved preferences, and more. We<!-- -->&#x27;re<!-- --> thrilled to have you with us again!
                    </div>
                    <div class="block-button md:mt-7 mt-4"><a class="button-main"
                            href="{{ route('Client.account.showLoginForm') }}">Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
