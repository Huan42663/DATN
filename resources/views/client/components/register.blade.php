<div class="register-block md:py-20 py-10">
    <div class="container">
        <div class="content-main flex gap-y-8 max-md:flex-col">
            <div class="left md:w-1/2 w-full lg:pr-[60px] md:pr-[40px] md:border-r border-line">
                <div class="heading4">Register</div>
                <form class="md:mt-7 mt-4">
                    <div class="email "><input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="username"
                            type="email" placeholder="Username or email address *" required="" /></div>
                    <div class="pass mt-5"><input class="border-line px-4 pt-3 pb-3 w-full rounded-lg" id="password"
                            type="password" placeholder="Password *" required="" /></div>
                    <div class="confirm-pass mt-5"><input class="border-line px-4 pt-3 pb-3 w-full rounded-lg"
                            id="confirmPassword" type="password" placeholder="Confirm Password *" required="" />
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="block-input"><input type="checkbox" id="remember" name="remember" /><svg
                                xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                viewBox="0 0 256 256" class="icon-checkbox">
                                <path
                                    d="M208,32H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32Zm-34.34,77.66-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35a8,8,0,0,1,11.32,11.32Z">
                                </path>
                            </svg></div><label for="remember" class="pl-2 cursor-pointer text-secondary2">I agree to
                            the<a class="text-black hover:underline pl-1" href="#!">Terms of User</a></label>
                    </div>
                    <div class="block-button md:mt-7 mt-4"><button class="button-main">Register</button></div>
                </form>
            </div>
            <div class="right md:w-1/2 w-full lg:pl-[60px] md:pl-[40px] flex items-center">
                <div class="text-content">
                    <div class="heading4">Already have an account?</div>
                    <div class="mt-2 text-secondary">Welcome back. Sign in to access your personalized experience,
                        saved preferences, and more. We<!-- -->&#x27;re<!-- --> thrilled to have you with us again!
                    </div>
                    <div class="block-button md:mt-7 mt-4"><a class="button-main" href="{{ route('Client.account.showLoginForm') }}">Login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
