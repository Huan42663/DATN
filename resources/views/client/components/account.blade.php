@extends('client.master')

@section('title', 'thông tin tài khoản')

@section('content')
    <div class="profile-block md:py-20 py-10">
        <div class="container">
            <div class="content-main flex gap-y-8 max-md:flex-col w-full">
                <div class="left md:w-1/3 w-full xl:pr-[3.125rem] lg:pr-[28px] md:pr-[16px]">
                    <div class="user-infor bg-surface lg:px-7 px-4 lg:py-10 py-5 md:rounded-[20px] rounded-xl">
                        <div class="heading flex flex-col items-center justify-center">
                            <div class="avatar">
                                <img alt="avatar"  loading="lazy" width="300" height="300" decoding="async"
                                    data-nimg="1" class="md:w-[140px] w-[120px] md:h-[140px] h-[120px] rounded-full"
                                    style="color: transparent"

                                    src="{{ asset('storage/' . $user->avatar) }}" />
                            </div>
                            <div class="name heading6 mt-4 text-center">
                                {{ $user->fullName }}
                            </div>
                            <div class="mail heading6 font-normal normal-case text-secondary text-center mt-1">
                                {{ $user->email }}
                            </div>
                        </div>
                        <div class="menu-tab w-full max-w-none lg:mt-10 mt-6">
                            @auth
                                @if (Auth::user()->role == 'admin'|| Auth::user()->role == 'manager')
                                    <!-- Kiểm tra nếu người dùng là admin -->
                                    <a class="item flex items-center gap-3 w-full px-5 py-4 rounded-lg cursor-pointer duration-300 hover:bg-white active"
                                        href="{{ route('Administration.Home') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M240,208H224V115.55a16,16,0,0,0-5.17-11.78l-80-75.48a1.14,1.14,0,0,1-.11-.11,16,16,0,0,0-21.53,0l-.11.11L37.17,103.77A16,16,0,0,0,32,115.55V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM48,115.55l.11-.1L128,40l79.9,75.43.11.1V208H160V160a16,16,0,0,0-16-16H112a16,16,0,0,0-16,16v48H48ZM144,208H112V160h32Z">
                                            </path>
                                        </svg><strong class="heading6">Trang Quản Trị</strong>
                                    </a>
                                @endif
                            @endauth
                                <a
                                class="item flex items-center gap-3 w-full px-5 py-4 rounded-lg cursor-pointer duration-300 hover:bg-white mt-1.5"
                                href="{{ route('Client.account.logout') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,221.66,122.34Z">
                                    </path>
                                </svg><strong class="heading6">Đăng Xuất</strong></a>
                        </div>
                    </div>
                </div>
                <div class="right md:w-2/3 w-full pl-2.5">
                    <div class="tab text-content w-full block">
                        <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl" style="background-color: #e7e2e2;">
                            @if(session('password_success'))
                                <div id="passwordSuccess" class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                                    {{ session('password_success') }}
                                </div>
                            @endif

                            @if(session('success'))
                                <div id="accountSuccess" class="alert alert-success bg-green-500 text-white p-3 rounded mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <h6 class="heading6">Đơn Hàng</h6>
                            <div class="list overflow-x-auto w-full mt-5">
                                <table class="w-full max-[1400px]:w-[700px] max-md:w-[700px]">
                                    <thead class="border-b border-line">
                                        <tr>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Mã Đơn Hàng
                                            </th>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Giá
                                            </th>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Ngày Đặt
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr class="item duration-300 border-b border-line">

                                                    <td scope="row" class="py-3 text-left">
                                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}">
                                                            <strong class="text-title">{{ $order->order_code }}</strong>
                                                        </a>
                                                    </td>
                                                    <td class="py-3">
                                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}">
                                                            <strong class="text-title">{{ number_format($order->total_discount, 0, ',', '.') }} VNĐ</strong>
                                                        </a>
                                                    </td>
                                                    <td class="py-3 price">
                                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}">
                                                            <strong class="text-title">{{ $order->created_at }}</strong>
                                                        </a>
                                                    </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab text-content w-full block">
                        <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl" style="background-color: #e7e2e2;">
                            <h6 class="heading6">Edit Account</h6>
                            <div class="list overflow-x-auto w-full mt-5">
                                <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl" >
                                    <form action="{{ route('Client.account.update') }}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
                                        @csrf
                                        @method('PUT')

                                        <!-- Fullname -->
                                        <div class="flex flex-col">
                                            <label for="fullname" class="text-sm font-medium">Fullname</label>
                                            <input type="text" name="fullName" id="fullName" value="{{ old('fullName', $user->fullName ?? '') }}"
                                                   class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                        </div>

                                        <!-- Email -->
                                        <div class="flex flex-col">
                                            <label for="email" class="text-sm font-medium">Email</label>
                                            <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}"
                                                   class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                        </div>

                                        <!-- Password -->

                                        <!-- Phone -->
                                        <div class="flex flex-col">
                                            <label for="phone" class="text-sm font-medium">Phone</label>
                                            <input type="text" name="phone" id="phone" value="{{ old('phone', $user->phone ?? '') }}"
                                                   class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                        </div>

                                        <!-- Avatar -->
                                        <div class="flex flex-col">
                                            <label for="avatar" class="text-sm font-medium">Avatar</label>
                                            <input type="file" name="avatar" id="avatar"
                                                   class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                            @if (!empty($user->avatar))
                                                <img src="{{ asset('storage/' . $user->avatar) }}" alt="Current Avatar" class="w-20 h-20 mt-2 rounded-full object-cover">
                                            @endif
                                        </div>

                                                            <!-- Change Password Section -->
                                        <div class="mt-8 border-t border-gray-300 pt-4">
                                            <h6 class="heading6">Change Password</h6>

                                            <!-- Current Password -->
                                            <div class="flex flex-col">
                                                <label for="current_password" class="text-sm font-medium">Current Password</label>
                                                <input type="password" name="current_password" id="current_password"
                                                    class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                                @error('current_password')
                                                    <div class="alert alert-danger text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- New Password -->
                                            <div class="flex flex-col">
                                                <label for="new_password" class="text-sm font-medium">New Password</label>
                                                <input type="password" name="new_password" id="new_password"
                                                    class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                                @error('new_password')
                                                    <div class="alert alert-danger text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Confirm New Password -->
                                            <div class="flex flex-col">
                                                <label for="new_password_confirmation" class="text-sm font-medium">Confirm New Password</label>
                                                <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                                                    class="border border-gray-300 rounded p-2 focus:outline-none focus:border-primary">
                                                @error('new_password_confirmation')
                                                    <div class="alert alert-danger text-sm mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <!-- Submit Button -->
                                        <div class="flex justify-end gap-3">
                                            {{-- <button type="reset" class="bg-gray-300 text-black py-2 px-4 rounded">Reset</button> --}}
                                            <button type="submit" class="bg-primary text-white py-2 px-4 rounded">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Ẩn thông báo sau 3 giây
        setTimeout(function() {
            const successMessages = document.querySelectorAll('.alert');
            successMessages.forEach(function(message) {
                message.style.display = 'none';
            });
        }, 3000); // 3000ms = 3 giây
    </script>
@endsection
