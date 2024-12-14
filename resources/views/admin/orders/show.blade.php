
@extends('admin.master')

@section('title', 'Chi Tiết Đơn Hàng')
@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Chi Tiết Đơn Hàng</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang Chủ</a></li>
                <li class="breadcrumb-item">Chi Tiết Đơn Hàng</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

<div class="main-content">
    <div class="tab-content">
        <div class="tab-pane fade active show" id="proposalTab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-between">
                                <div class="col-lg-4 proposal-from">
                                    <h4 class="fw-bold mb-4">Thông tin người gửi:</h4>
                                    <div class="fs-13 text-muted lh-lg">
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Số Điện Thoại:</span>
                                            <span>0123456789</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Email:</span>
                                            <span>jsstore@gmail.com</span>
                                        </div>
                                        <address>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Địa Chỉ:</span>
                                            <span>123 Mỹ Đình 1, Nam Từ Liêm, Hà Nội</span><br>
                                        </address>
                                        <div class="d-flex gap-2">
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                <i class="feather-facebook"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                <i class="feather-twitter"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                <i class="feather-instagram"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                <i class="feather-linkedin"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                <i class="feather-github"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <hr class="d-md-none">
                                <div class="row col-lg-8 proposal-to">
                                    <h4 class="fw-bold mb-4">Thông tin người nhận:</h4>
                                    <div class="col-5 fs-13 lh-lg">
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Mã Đơn Hàng:</span>
                                            <span class="fw-bold text-primary">#{{$infoOrder[0]->order_code}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Ngày Đặt:</span>
                                            <span class="text-muted">{{$infoOrder[0]->created_at}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Họ và Tên:</span>
                                            <span>{{$infoOrder[0]->fullname}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Số Điện Thoại:</span>
                                            <span>{{$infoOrder[0]->phone}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Email:</span>
                                            <span>{{$infoOrder[0]->email}}</span>
                                        </div>
                                    </div>
                                    <div class="col-7 fs-13 text-muted lh-lg ">
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Tỉnh\Thành Phố:</span>
                                            <span>{{$infoOrder[0]->province}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Quận\Huyện:</span>
                                            <span>{{$infoOrder[0]->district}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Phường\Xã:</span>
                                            <span>{{$infoOrder[0]->ward}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Đường:</span>
                                            <span>{{$infoOrder[0]->street}}</span>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Tổ Dân Phố\Thôn:</span>
                                            <span>{{$infoOrder[0]->hamlet}}</span>
                                        </div>
                                        <address class="mb-0">
                                            <span class="fw-semibold text-dark border-bottom border-bottom-dashed">Địa Chỉ Cụ Thể:</span>
                                            <span>{{$infoOrder[0]->address}}</span>
                                        </address>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($bill != null)
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <h4>Hóa Đơn Thanh Toán</h4>
                                <br>
                                <p><span class="fs-6 fw-bold">Mã ngân hàng : </span>{{$bill->bank_code}}</p>
                                <p><span class="fs-6 fw-bold">Mã giao dịch : </span>{{$bill->bank_tranno}}</p>
                                <p><span class="fs-6 fw-bold">Số Tiền : </span>{{$bill->amount}}</p>
                                <p><span class="fs-6 fw-bold">Loại thẻ : </span>{{$bill->card_type}}</p>
                                <p><span class="fs-6 fw-bold">Mã giao dịch VnPay : </span>{{$bill->vnpay_transactionno}}</p>
                                <p><span class="fs-6 fw-bold">Thời gian giao dịch : </span>{{$bill->created_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-xl-12">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <h4>Thông Tin Đơn Hàng</h4>
                            </div>
                            <div class="col-md-4 mb-4 d-flex justify-content-start">
                                <label class="form-label mt-1 me-2">Trạng Thái Đơn Hàng : </label>
                                @if ($infoOrder[0]->status == "unconfirm")
                                    <span class="badge bg-soft-warning text-warning me-2" style="padding:10px">Chờ Xác Nhận</span>
                                @elseif($infoOrder[0]->status == "confirmed")   
                                    <span class="badge bg-soft-success text-success me-2" style="padding:10px">Đã Xác Nhận</span>
                                @elseif($infoOrder[0]->status == "shipping")
                                    <span class="badge bg-soft-primary text-primary me-2" style="padding:10px">Đang Vận Chuyển</span>
                                @elseif($infoOrder[0]->status == "delivered")
                                    <span class="badge bg-soft-info text-info me-2" style="padding:10px">Đã Giao Đến Khách Hàng</span>
                                @elseif($infoOrder[0]->status == "received")
                                    <span class="badge bg-soft-success text-success me-2" style="padding:10px">Đã Xác Nhận Nhận Hàng</span>
                                @elseif($infoOrder[0]->status == "canceled")
                                        <span class="badge bg-soft-danger text-danger me-2" style="padding:10px">Hủy</span>
                                @elseif($infoOrder[0]->status == "return")
                                    <span class="badge bg-soft-dark text-dark me-2" style="padding:10px">Trả Hàng</span>
                                @endif
                                @if ($infoOrder[0]->status != "delivered" && $infoOrder[0]->status != "received" && $infoOrder[0]->status != "canceled" && $infoOrder[0]->status != "return")
                                <form action="{{route('Administration.orders.update', $infoOrder[0]->order_id )}}" method="post" class="d-flex">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="order_id" value="{{$infoOrder[0]->status}}">
                                    <input type="hidden" name="order_status" value="{{$infoOrder[0]->order_id}}">
                                    <button class="btn btn-success" style="height: 35px;">Cập Nhật</button>
                                </form>
                                @endif
                            </div>
                            <div class="col-md-12 mb-4">
                                <label class="form-label">Danh Sách Sản Phẩm</label>
                                <div class="col-lg-12 mt-3" >
                                    <div class="card stretch stretch-full">
                                        <div class="card-body custom-card-action p-0">
                                            <div class="table-responsive" style="padding: 20px;">
                                                <table class="table table-hover mb-0">
                                                    <thead>
                                                        <tr>
                                                            <th>Ảnh</th>
                                                            <th>Tên Sản Phẩm</th>
                                                            <th>Kích Thước, Màu Sắc</th>
                                                            <th>Giá</th>
                                                            <th>Số Lượng</th>
                                                            <th>Thành Tiền</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($detail as $value )
                                                        <tr>
                                                            <td>
                                                                <span class="fs-12 text-muted d-block"><img src="{{asset("storage/".$value->product_image)}}" alt="{{$value->product_image}}" width="100"></span>
                                                            </td>
                                                            <td>
                                                                <span  class="d-block mb-1 fs-6 fw-bold">{{$value->product_name}}</span>
                                                            </td>
                                                            <td>
                                                                <span  class="d-block mb-1">{{$value->size}}, {{$value->color}}</span>
                                                            </td>
                                                            <td class="fw-bold">
                                                                @if($value->sale_price !=null || $value->sale_price > 0)
                                                                    <span  class="d-block mb-1 text-danger">{{number_format($value->sale_price, 0, ',', '.') . 'VNĐ';}}</span>
                                                                    <del class="text-secondary">{{number_format($value->price, 0, ',', '.') . ' VNĐ';}}</del>
                                                                @else
                                                                    <span  class="d-block mb-1 text-danger">{{number_format($value->price, 0, ',', '.') . ' VNĐ';}}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span  class="d-block mb-1 fw-bold">{{$value->quantity}}</span>
                                                            </td>
                                                            <td class="fw-bold">
                                                                @if($value->sale_price !=null || $value->sale_price > 0)
                                                                    <span  class="d-block mb-1 text-danger">{{number_format($value->sale_price * $value->quantity, 0, ',', '.') . ' VNĐ';}}</span>
                                                                @else
                                                                    <span  class="d-block mb-1 text-danger">{{number_format($value->price * $value->quantity, 0, ',', '.') . ' VNĐ';}}</span>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <span  class="d-block mb-1 text-secondary fs-6 fw-bold" >{{"Giá gốc: ".number_format($infoOrder[0]->total - 30000, 0, ',', '.') . ' VNĐ';}}</span>
                                                                <span  class="d-block mb-1 text-secondary fs-6 fw-bold" >{{ "Phí vận chuyển: ".number_format(30000, 0, ',', '.') . ' VNĐ';}}</span>
                                                                @if($infoOrder[0]->total > $infoOrder[0]->total_discount && $infoOrder[0]->total_discount !=null )
                                                                    <span class="text-secondary fs-6 fw-bold">{{"Giá khuyến mãi: -".number_format( $infoOrder[0]->total - $infoOrder[0]->total_discount, 0, ',', '.') . ' VNĐ';}}</span>
                                                                    <br>
                                                                        @if($bill != null)
                                                                        <span class="text-danger fs-4 fw-bold">{{"Tổng : ".number_format($infoOrder[0]->total_discount, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        <span class="badge bg-soft-success text-success">Đã Thanh Toán</span>
                                                                        <span class="text-danger fs-4 fw-bold">Số tiền cần thu : 0 VNĐ</span>
                                                                        @else
                                                                        <span class="text-danger fs-4 fw-bold">{{"Tổng : ".number_format($infoOrder[0]->total_discount, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        <span class="text-danger fs-4 fw-bold">{{"Số tiền cần thu : ".number_format($infoOrder[0]->total_discount, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        @endif
                                                                    @else
                                                                        @if($bill != null)
                                                                        <span class="text-danger fs-4 fw-bold">{{"Tổng : ".number_format($infoOrder[0]->total, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        <span class="badge bg-soft-success text-success">Đã Thanh Toán</span>
                                                                        <span class="text-danger fs-4 fw-bold">Số tiền cần thu : 0 VNĐ</span>
                                                                        @else
                                                                        <span class="text-danger fs-4 fw-bold">{{"Tổng : ".number_format($infoOrder[0]->total, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        <span class="text-danger fs-4 fw-bold">{{"Số tiền cần thu : ".number_format($infoOrder[0]->total, 0, ',', '.') . ' VNĐ';}}</span>
                                                                        @endif
                                                                    @endif
                                                                @endif
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


