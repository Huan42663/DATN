@extends('admin.master')

@section('title', 'chi tiết sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sự kiện</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">Chi tiết</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-xxl-4 col-xl-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0">Tên sự kiện: {{ $event->event_name }}</h5>
                        </div>
                        <table class="table">
                            <tr>
                                <th>Ngày bắt đầu </th>
                                <td>{{ $event->date_start }}</td>
                            </tr>
                            <tr>
                                <th>Ngày kết thúc</th>
                                <td>{{ $event->date_end }}</td>
                            </tr>
                            <tr>
                                <th>Kiểu sự kiện</th>
                                <td>
                                    @if ($event->type_event == '1')
                                        <span class="badge bg-soft-primary text-success"> Giảm giá</span>
                                    @elseif ($event->type_event == '0')
                                        <span class="badge bg-soft-danger text-warning"> Giới thiệu</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Trạng thái</th>
                                <td>
                                    @if ($event->status == '1')
                                        <span class="badge bg-soft-primary text-primary"> Đang hoạt động</span>
                                    @elseif ($event->status == '0')
                                        <span class="badge bg-soft-danger text-danger"> Ngừng hoạt động</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-6">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">Danh sách sản phẩm trong sự kiện:</h5>
                                </div>
                            </div>
                            <form action="{{ route('Administration.events.show-remove', $event->slug) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="profile-details mb-5">
                                    <div class="table-responsive">
                                        <table class="table" id="example">
                                            <thead>
                                                <th></th>
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh sản phẩm</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($product_event as $product)
                                                    <tr class="">
                                                        <td><input name="products[]" value="{{ $product->product_id }}"
                                                                type="checkbox"></td>
                                                        <td scope="row">{{ $product->product_name }}</td>
                                                        <td><img width="100px" src="{{ asset('storage/' . $product->product_image) }}"
                                                                alt=""></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mb-5 d-flex align-items-center justify-content-between">
                                        <button type="submit"class=" btn btn-light-brand">
                                            <i class="feather-trash-2 me-2"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">Thêm sản phẩm vào sự kiện:</h5>
                                </div>
                            </div>
                            <form action="{{ route('Administration.events.show-add', $event->slug) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="profile-details mb-5">
                                    <div class="table-responsive">
                                        <table class="table" id="example-1">
                                            <thead>
                                                <th></th>
                                                <th>Tên sản phẩm</th>
                                                <th>Ảnh sản phẩm</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr class=""
                                                        @foreach ($product_event as $item)
                                                    @if ($item->product_id == $product->product_id)
                                                        style="display: none"
                                                            @endif @endforeach>
                                                        <td>
                                                            <input name="products[]" value="{{ $product->product_id }}"
                                                                type="checkbox">
                                                        </td>
                                                        <td scope="row">{{ $product->product_name }}</td>
                                                        <td><img width="100px" src="{{ asset('storage/' . $product->product_image) }}"
                                                                alt=""></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="mb-5 d-flex align-items-center justify-content-between">
                                        <button type="submit"class=" btn btn-light-brand">
                                            <i class="feather-plus me-2"></i> ADD
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
