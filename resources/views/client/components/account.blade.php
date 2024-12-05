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
                                @if (Auth::user()->role == 'admin')
                                    <!-- Kiểm tra nếu người dùng là admin -->
                                    <a class="item flex items-center gap-3 w-full px-5 py-4 rounded-lg cursor-pointer duration-300 hover:bg-white active"
                                        href="{{ route('Administration.Home') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            fill="currentColor" viewBox="0 0 256 256">
                                            <path
                                                d="M240,208H224V115.55a16,16,0,0,0-5.17-11.78l-80-75.48a1.14,1.14,0,0,1-.11-.11,16,16,0,0,0-21.53,0l-.11.11L37.17,103.77A16,16,0,0,0,32,115.55V208H16a8,8,0,0,0,0,16H240a8,8,0,0,0,0-16ZM48,115.55l.11-.1L128,40l79.9,75.43.11.1V208H160V160a16,16,0,0,0-16-16H112a16,16,0,0,0-16,16v48H48ZM144,208H112V160h32Z">
                                            </path>
                                        </svg><strong class="heading6">Dashboard</strong>
                                    </a>
                                @endif
                            @endauth
                                <a
                                class="item flex items-center gap-3 w-full px-5 py-4 rounded-lg cursor-pointer duration-300 hover:bg-white mt-1.5"
                                href=""><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M128,80a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Zm109.94-52.79a8,8,0,0,0-3.89-5.4l-29.83-17-.12-33.62a8,8,0,0,0-2.83-6.08,111.91,111.91,0,0,0-36.72-20.67,8,8,0,0,0-6.46.59L128,41.85,97.88,25a8,8,0,0,0-6.47-.6A112.1,112.1,0,0,0,54.73,45.15a8,8,0,0,0-2.83,6.07l-.15,33.65-29.83,17a8,8,0,0,0-3.89,5.4,106.47,106.47,0,0,0,0,41.56,8,8,0,0,0,3.89,5.4l29.83,17,.12,33.62a8,8,0,0,0,2.83,6.08,111.91,111.91,0,0,0,36.72,20.67,8,8,0,0,0,6.46-.59L128,214.15,158.12,231a7.91,7.91,0,0,0,3.9,1,8.09,8.09,0,0,0,2.57-.42,112.1,112.1,0,0,0,36.68-20.73,8,8,0,0,0,2.83-6.07l.15-33.65,29.83-17a8,8,0,0,0,3.89-5.4A106.47,106.47,0,0,0,237.94,107.21Zm-15,34.91-28.57,16.25a8,8,0,0,0-3,3c-.58,1-1.19,2.06-1.81,3.06a7.94,7.94,0,0,0-1.22,4.21l-.15,32.25a95.89,95.89,0,0,1-25.37,14.3L134,199.13a8,8,0,0,0-3.91-1h-.19c-1.21,0-2.43,0-3.64,0a8.08,8.08,0,0,0-4.1,1l-28.84,16.1A96,96,0,0,1,67.88,201l-.11-32.2a8,8,0,0,0-1.22-4.22c-.62-1-1.23-2-1.8-3.06a8.09,8.09,0,0,0-3-3.06l-28.6-16.29a90.49,90.49,0,0,1,0-28.26L61.67,97.63a8,8,0,0,0,3-3c.58-1,1.19-2.06,1.81-3.06a7.94,7.94,0,0,0,1.22-4.21l.15-32.25a95.89,95.89,0,0,1,25.37-14.3L122,56.87a8,8,0,0,0,4.1,1c1.21,0,2.43,0,3.64,0a8.08,8.08,0,0,0,4.1-1l28.84-16.1A96,96,0,0,1,188.12,55l.11,32.2a8,8,0,0,0,1.22,4.22c.62,1,1.23,2,1.8,3.06a8.09,8.09,0,0,0,3,3.06l28.6,16.29A90.49,90.49,0,0,1,222.9,142.12Z">
                                    </path>
                                </svg><strong class="heading6">Edit</strong></a><a
                                class="item flex items-center gap-3 w-full px-5 py-4 rounded-lg cursor-pointer duration-300 hover:bg-white mt-1.5"
                                href="{{ route('Client.account.logout') }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    fill="currentColor" viewBox="0 0 256 256">
                                    <path
                                        d="M112,216a8,8,0,0,1-8,8H48a16,16,0,0,1-16-16V48A16,16,0,0,1,48,32h56a8,8,0,0,1,0,16H48V208h56A8,8,0,0,1,112,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L196.69,120H104a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,221.66,122.34Z">
                                    </path>
                                </svg><strong class="heading6">Logout</strong></a>
                        </div>
                    </div>
                </div>
                <div class="right md:w-2/3 w-full pl-2.5">
                    <div class="tab text-content w-full block">
                        <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl">
                            <h6 class="heading6">Recent Orders</h6>
                            <div class="list overflow-x-auto w-full mt-5">
                                <table class="w-full max-[1400px]:w-[700px] max-md:w-[700px]">
                                    <thead class="border-b border-line">
                                        <tr>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Order Code
                                            </th>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Price
                                            </th>
                                            <th scope="col"
                                                class="pb-3 text-left text-sm font-bold uppercase text-secondary whitespace-nowrap">
                                                Date of Booking
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr class="item duration-300 border-b border-line">
                                                <td scope="row" class="py-3 text-left">
                                                    <strong class="text-title">{{ $order->order_code }}</strong>
                                                </td>
                                                <td class="py-3">
                                                    <strong class="text-title">{{ number_format($order->total_discount / 1, 0) }}</strong>
                                                </td>
                                                <td class="py-3 price">
                                                    <strong class="text-title">{{ $order->created_at }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab text-content w-full block">
                        <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl">
                            <h6 class="heading6">Edit Account</h6>
                            <div class="list overflow-x-auto w-full mt-5">
                                <div class="recent_order pt-5 px-5 pb-2 mt-7 border border-line rounded-xl">
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

@endsection
