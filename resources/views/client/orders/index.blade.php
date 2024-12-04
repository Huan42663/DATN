@extends('client.master')
@section('title', 'Danh sách đơn hàng')

@section('content')

    <div class="order-tracking py-10 bg-light" style="background-color: #f8f9fa; padding: 40px 0;">
        <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 15px;">
            <div class="content-main">
                <h3 class="fancy-title">Đơn hàng của bạn</h3>

                <style>
                    .fancy-title {
                        font-size: 30px;
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
                </style>



                <div class="order-list"
                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; max-width: 100%; margin: 0;">
                    @forelse ($orders as $order)
                        <div class="order-item"
                            style="background-color: #ffffff; border-radius: 15px; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1); overflow: hidden; transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;">
                            <!-- Thông tin đơn hàng -->
                            <div class="order-info" style="margin-bottom: 20px; padding: 20px;">
                                <h5 class="order-code"
                                    style="font-size: 20px; font-weight: bold; color: #57b269; margin-bottom: 10px;">
                                    #{{ $order->order_code }}</h5>
                                <p class="order-date" style="font-size: 14px; color: #777; margin-bottom: 15px;">Ngày đặt:
                                    {{ $order->created_at->format('d/m/Y H:i') }}</p>
                                <div class="order-status mb-3">
                                    <span style="font-size: 14px; color: #777; margin-bottom: 15px;">Trạng thái:</span>
                                    <span class="badge"
                                        style="font-size: 0.875rem; padding: 8px 15px; border-radius: 20px; 
                                background-color: #7e9da1;">

                                    @if ($order->status == 'unconfirm')
                                        <span class="badge bg-soft-warning text-warning">Chờ Xác Nhận</span>
                                    @elseif($order->status == 'confirmed')
                                        <span class="badge bg-soft-success text-success">Đã Xác Nhận</span>
                                    @elseif($order->status == 'shipping')
                                        <span class="badge bg-soft-success text-success">Đang Vận Chuyển</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-soft-success text-success">Đã Giao Đến Khách Hàng</span>
                                    @elseif($order->status == 'received')
                                        <span class="badge bg-soft-warning text-warning">Đã Xác Nhận Nhận Hàng</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="badge bg-soft-danger text-danger">Hủy</span>
                                    @elseif($order->status == 'return')
                                        <span class="badge bg-soft-dark text-dark">Trả Hàng</span>
                                    @endif
                                    </span>
                                </div>
                                <div class="order-total"
                                    style="font-size: 1.25rem; font-weight: bold; color: #333; margin-bottom: 15px;">
                                    Tổng tiền: <span style="color: #000;">{{ number_format($order->total, 0, ',', '.') }}
                                        đ</span>
                                </div>
                            </div>

                            <!-- Thao tác -->
                            <div class="order-actions"
                                style="display: flex; flex-direction: column; gap: 15px; padding: 0 20px 20px;">
                                <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                    style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; font-weight: 500; background-color: #59a0ed; color: white; border-radius: 5px; text-align: center; text-decoration: none; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease;">
                                    Xem chi tiết
                                </a>

                                @if ($order->status == 'unconfirm')
                                    <form
                                        action="{{ route('Client.orders.cancel', [$order->order_code, $order->order_id]) }}"
                                        method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"
                                        style="margin: 0;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; background-color: #e74c3c; color: white; border-radius: 5px; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-align: center;">
                                            Hủy đơn hàng
                                        </button>
                                    </form>
                                @endif

                                @if ($order->status == 'delivered')
                                    <form
                                        action="{{ route('Client.orders.confirmDelivered', [$order->order_code, $order->order_id]) }}"
                                        method="POST" onsubmit="return confirm('Bạn đã nhận đơn hàng này?')"
                                        style="margin: 0;">
                                        @csrf
                                        @method('POST')
                                        <button type="submit"
                                            style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; background-color: #28a745; color: white; border-radius: 5px; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-align: center;">
                                            Xác nhận đã nhận hàng
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <div class="alert alert-warning" role="alert"
                                style="font-size: 16px; padding: 15px; background-color: #fff3cd; color: #856404; border-radius: 5px;">
                                Không có đơn hàng nào.
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>









@endsection
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (đặt trước </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
