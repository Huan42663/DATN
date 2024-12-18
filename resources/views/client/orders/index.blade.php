@extends('client.master')
@section('title', 'Danh sách đơn hàng')

@section('content')

    <div class="order-tracking pt-10">
        <div class="box">
            <div class="container">
                <div class="content-main " style="margin-top: 70px">
                    <h4 style="padding-top:30px" class="fancy-title">Đơn hàng của bạn</h4>
                    <div class="order-list">
                        @forelse ($orders as $order)
                            <div class="order-item">
                                <!-- Thông tin đơn hàng -->
                                <div class="order-info">
                                    <h5 class="order-code">#{{ $order->order_code }}</h5>
                                    <input type="hidden" id="{{ 'order_code' . $order->order_code }}"
                                        value="{{ $order->order_code }}">
                                    <span class="{{ 'order_code' . $order->order_code }}" hidden></span>
                                    <p class="order-date">Ngày đặt: {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                    <div class="order-status mb-3">
                                        <span>Trạng thái:</span>
                                        <span class="badge">
                                            @if ($order->status == 'unconfirm')
                                                <span class="badge bg-soft-warning text-warning">Chờ Xác Nhận</span>
                                            @elseif($order->status == 'confirmed')
                                                <span class="badge bg-soft-success text-success">Đã Xác Nhận</span>
                                            @elseif($order->status == 'shipping')
                                                <span class="badge bg-soft-info text-info">Đang Vận Chuyển</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="badge bg-soft-primary text-primary">Đã Giao Đến Khách
                                                    Hàng</span>
                                            @elseif($order->status == 'received')
                                                <span class="badge bg-soft-success text-success">Đã Xác Nhận Nhận
                                                    Hàng</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="badge bg-soft-danger text-danger">Hủy</span>
                                            @elseif($order->status == 'return')
                                                <span class="badge bg-soft-dark text-dark">Trả Hàng</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="order-total">
                                        @if ($order->total >= $order->total_discount && $order->total_discount != null)
                                            <span>Tổng tiền: {{ number_format($order->total_discount, 0, ',', '.') }}
                                                VNĐ</span>
                                        @else
                                            <span>Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} VNĐ</span>
                                        @endif
                                        <br>
                                        @if ($order->method_payment == 'banking')
                                            <span class="text-success">Đã Thanh Toán</span>
                                        @else
                                            <span class="text-light">Chưa Thanh Toán</span>
                                        @endif
                                    </div>
                                </div>

                                <!-- Phần nút hành động -->
                                <div class="order-actions d-flex justify-content-between">
                                    <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                        class="btn btn-detail">Xem chi tiết</a>
                                    @if ($order->status == 'unconfirm')
                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                            class="btn btn-cancel">Hủy đơn hàng</a>
                                    @endif
                                    @if ($order->status == 'delivered')
                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                            class="btn btn-confirm">Xác nhận đã nhận hàng</a>
                                        <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                            class="btn btn-return">Trả hàng</a>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-warning">Không có đơn hàng nào.</div>
                        @endforelse
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $orders->links() }}
                </div>
            </div>

        </div>
    </div>

    <style>
        .box {
            padding-bottom: 30px;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .fancy-title {
            font-size: 25px;
            font-weight: bold;
            color: #333;
            margin-bottom: 30px;
            text-align: center;
            text-transform: uppercase;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }

        .fancy-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #15375c;
            transform: scaleX(0);
            transform-origin: bottom right;
            transition: transform 0.4s ease-out;
        }

        .fancy-title:hover {
            color: #548ec8;
        }

        .fancy-title:hover::after {
            transform: scaleX(1);
            transform-origin: bottom left;
        }

        .order-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
        }

        .order-item {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
            overflow: hidden;
        }

        .order-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .order-info {
            padding: 20px;
        }

        .order-code {
            font-size: 20px;
            font-weight: bold;
            color: #57b269;
            margin-bottom: 10px;
        }

        .order-date {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }

        .order-status span {
            font-size: 14px;
            color: #777;
        }

        .order-total {
            font-size: 1.25rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }

        .order-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            padding: 15px;
        }

        .btn {
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-detail {
            background-color: #fff;
            color: #57b269;
            border: 1px solid #57b269;
        }

        .btn-cancel {
            background-color: #e74c3c;
            color: #fff;
        }

        .btn-confirm {
            background-color: #28a745;
            color: #fff;
        }

        .btn-return {
            background-color: black;
            color: #fff;
        }

        .alert {
            padding: 15px;
            background-color: #fff3cd;
            color: #856404;
            border-radius: 5px;
            text-align: center;
        }
    </style>

    <script>
        // $('#cancel').click(function(){
        //     var order_code = $('#order_code').val();
        //     const route = "{{ route('Client.orders.cancel') }}"
        //     $.ajax({
        //         url: route ,
        //         method: "POST",
        //         data: {
        //             _token : $('meta[name="csrf-token"]').attr('content'),
        //             order_code: order_code,
        //         },
        //         dataType: "json",
        //         success: function(response) {
        //             swal({
        //                 icon: "success",
        //                 title:response.data,
        //             }).then(()=>{
        //                 $('#order_status').html(`<span class="badge bg-soft-danger text-danger">Hủy</span>`)
        //                 $('#cancel').addClass('d-none')
        //             });
        //         },
        //         error: function(error){
        //             swal({
        //                 icon: "error",
        //                 title: error.responseJSON.data,
        //             })
        //         }
        //     });

        // });

        // $('#confirm').click(function(){
        //     var order_code = $('#order_code').val();
        //     const route = "{{ route('Client.orders.confirmDelivered') }}"
        //     $.ajax({
        //         url: route ,
        //         method: "POST",
        //         data: {
        //             _token : $('meta[name="csrf-token"]').attr('content'),
        //             order_code: order_code,
        //         },
        //         dataType: "json",
        //         success: function(response) {
        //             swal({
        //                 icon: "success",
        //                 title:response.data,
        //             }).then(()=>{
        //                 $('#order_status').html(`<span class="badge bg-soft-warning text-warning">Đã Xác Nhận Nhận Hàng</span>`)
        //                 $('#confirm').html()
        //             });
        //         },
        //         error: function(error){
        //             swal({
        //                 icon: "error",
        //                 title: error.responseJSON.data,
        //             })
        //             console.log(error);
        //         }
        //     });

        // });
    </script>







@endsection

{{-- <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
