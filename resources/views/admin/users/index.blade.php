@extends('admin.master')

@section('title', 'danh sách tài khoản')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Users</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- [Recent Orders] start -->
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                @session('massage')
                    <p class="bg-success">{{ $massage }}</p>
                @endsession
                <div class="table-responsive">
                    <a href="{{ route('Administration.users.create') }}" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>ADD NEW ADMIN</span>
                    </a>
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Họ Và Tên</th>
                                <th>Email</th>
                                <th>Số Điện Thoại</th>
                                <th>Ảnh Đại Diện</th>
                                <th>Chức Vụ</th>
                                <th>Trạng Thái</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                @if ($user->role == 'guest' && Auth::user()->role == 'admin')
                                    <tr>
                                        <td>{{ $user->fullName }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td><img src="{{ asset('storage/' . $user->avatar) }}" alt=""></td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge bg-soft-success text-success">Hoạt Động</span>
                                            @elseif ($user->status == 0)
                                                <span class="badge bg-soft-danger text-danger">Ngừng Hoạt Động</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                @if ($user->status > 0)
                                                    <form action="{{ route('Administration.users.destroy', $user) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('bạn có muốn ngừng hoạt động tài khoản này ?') "
                                                            class="avatar-text avatar-md">
                                                            <i class="feather-alert-circle">
                                                            </i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('Administration.users.show', $user) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @elseif (Auth::user()->role == 'manager' && $user->role != 'manager')
                                    <tr>
                                        <td>{{ $user->fullName }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td><img src="{{ asset('storage/' . $user->avatar) }}" alt=""></td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if ($user->status == 1)
                                                <span class="badge bg-soft-success text-success">Hoạt Động</span>
                                            @elseif ($user->status == 0)
                                                <span class="badge bg-soft-danger text-danger">Ngừng Hoạt Động</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                @if ($user->status > 0)
                                                    <form action="{{ route('Administration.users.destroy', $user) }}"
                                                        method="POST">
                                                        @method('PUT')
                                                        @csrf
                                                        <button
                                                            onclick="return confirm('bạn có muốn ngừng hoạt động tài khoản này ?') "
                                                            class="avatar-text avatar-md">
                                                            <i class="feather-alert-circle">
                                                            </i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <a href="{{ route('Administration.users.show', $user) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather-edit"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [Recent Orders] end -->
@endsection
