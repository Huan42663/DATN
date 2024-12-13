@extends('admin.master')

@section('title', 'danh sách sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sự kiện</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">Danh sách</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success mt-1" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger mt-1" role="alert">
            {{ session('error') }}
        </div>
    @endif
    <!-- [Recent Orders] start -->
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <a href="{{ route('Administration.events.listDelete') }}"><button class="btn btn-danger"><i
                        class="bi bi-trash3 me-2"></i>Thùng Rác</button></a>
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tên sự kiện</th>
                                <th>Kiểu sự kiện</th>
                                <th>Giảm giá</th>
                                <th>Trạng thái</th>
                                <th>Ngày bắt đầu</th>
                                <th>Ngày kết thúc</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($events as $event)
                                <tr>
                                    <td>
                                        <div class="hstack gap-3">

                                            <div>
                                                <span class="d-block">{{ $event->event_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{ $event->type_event }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{ $event->discount }}</span>
                                    </td>
                                    <td>
                                        @if ($event->status == '1')
                                            <span class="badge bg-soft-primary text-primary"> Đang hoạt động</span>
                                        @elseif ($event->status == '0')
                                            <span class="badge bg-soft-danger text-danger"> Ngừng hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{ $event->date_start }}</span>
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{ $event->date_end }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{ route('Administration.events.show', $event->slug) }}"
                                                class="avatar-text avatar-md">
                                                <i class="feather-eye"></i>
                                            </a>
                                            <a href="{{ route('Administration.events.edit', $event->event_id) }}"
                                                class="avatar-text avatar-md">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form action="{{ route('Administration.events.destroy', $event->event_id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button onclick="return confirm(' có chắc xóa sự kiện này không ?')"
                                                    type="submit" class="avatar-text avatar-md">
                                                    <i class="feather-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- [Recent Orders] end -->
@endsection
