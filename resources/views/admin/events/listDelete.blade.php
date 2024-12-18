@extends('admin.master')

@section('title', 'Thùng rác')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sự kiện</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">Thùng rác</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- [Recent Orders] start -->
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
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
                                <th>Ngày xóa</th>
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
                                    <td>
                                        <span class="d-block mb-1">{{ $event->deleted_at }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <form action="{{ route('Administration.events.restore') }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" value="{{ $event->event_id }}" name="event_id"
                                                    id="">
                                                <button class="btn btn-success me-2" type="submit">Khôi Phục</button>
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
