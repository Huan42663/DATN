@extends('client.master')
@section('title', 'Danh sách đơn hàng')

@section('content')
    <div class="container">
        <div
            style="display: flex; padding: 20px; background-color: #f4f4f4; font-family: 'Roboto', sans-serif; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
            <!-- Sidebar -->
            <div
                style="margin-left: 20px; width: 300px; background-color: #ffffff; padding: 20px; border-radius: 15px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); font-family: 'Roboto', sans-serif;">
                <ul >
                    <!-- Mục tài khoản -->
                    <li >
                        <a href="{{ route('Client.account.show') }}"
                            style="display: flex; align-items: center; font-size: 18px; color: #0f0e0e; font-weight: 00; padding: 12px 20px; border-radius: 10px; text-decoration: none; transition: all 0.3s; background-color: #f8f9fa;">
                            Tài Khoản
                        </a>
                    </li>

                    <!-- Mục đơn hàng -->
                    <li >
                        <a href="{{ route('Client.orders.list') }}"
                            style="display: flex; align-items: center; font-size: 18px; color: #0b0b0b; font-weight: 400; padding: 12px 20px; border-radius: 10px; text-decoration: none; transition: all 0.3s; background-color: #f8f9fa;">
                            Đơn Hàng
                        </a>
                    </li>
                </ul>
            </div>


            <!-- Nội dung đơn hàng -->
            <div
                style="width: 70%; padding: 20px; background-color: #ffffff; border-radius: 10px; margin-left: 20px; box-shadow: 0 4px 8px rgba(6, 6, 6, 0.1);">
                <h2 style="font-size: 26px; font-weight: bold; color: #333; text-align: center; margin-bottom: 20px;">Danh
                    sách Đơn Hàng</h2>

                @forelse ($orders as $order)
                    <!-- Phần thông tin đơn hàng -->
                    <div
                        style="border: 1px solid #d4caca; padding: 20px; margin-bottom: 15px; border-radius: 10px; background-color: #f9f9f9; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                        <!-- Mã đơn hàng và ngày đặt -->
                        <div
                            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                            <span style="font-size: 20px; font-weight: bold; color: #333;">Mã đơn hàng: <span
                                    style="color: #57b269;">#{{ $order->order_code }}</span></span>
                            <span style="font-size: 14px; color: #999;">Ngày đặt:
                                {{ $order->created_at->format('d/m/Y') }}</span>
                        </div>

                        <!-- Địa chỉ giao hàng -->
                        <div style="font-size: 16px; color: #555; margin-bottom: 10px;">
                            <p><strong style="color: #333;">Giao đến:</strong> {{ $order->address }}</p>
                        </div>

                        <!-- Trạng thái và tổng tiền -->
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <div class="order-status">
                                <span style="font-size: 16px; color: #555;">Trạng thái:</span>
                                @switch($order->status)
                                    @case('unconfirm')
                                        <span style="font-size: 14px; font-weight: bold; color: #ff9800;">Chờ Xác Nhận</span>
                                    @break

                                    @case('confirmed')
                                        <span style="font-size: 14px; font-weight: bold; color: #4caf50;">Đã Xác Nhận</span>
                                    @break

                                    @case('shipping')
                                        <span style="font-size: 14px; font-weight: bold; color: #03a9f4;">Đang Vận Chuyển</span>
                                    @break

                                    @case('delivered')
                                        <span style="font-size: 14px; font-weight: bold; color: #3f51b5;">Đã Giao Đến</span>
                                    @break

                                    @case('canceled')
                                        <span style="font-size: 14px; font-weight: bold; color: #f44336;">Hủy</span>
                                    @break

                                    @case('return')
                                        <span style="font-size: 14px; font-weight: bold; color: #616161;">Trả Hàng</span>
                                    @break

                                    @default
                                        <span style="font-size: 14px; font-weight: bold; color: #9e9e9e;">Chưa Xác Nhận</span>
                                @endswitch
                            </div>

                            <div style="font-size: 16px; color: #333;">
                                <strong style="color: #000;">Tổng tiền:</strong> <span
                                    style="color: #f80e0e; font-weight: 500">{{ number_format($order->total_discount, 0, ',', '.') }}
                                    đ</span>
                            </div>
                        </div>

                        <!-- Phần nút hành động -->
                        <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 15px;">
                            <a href="{{ route('Client.orders.show', [$order->order_code, $order->order_id]) }}"
                                style="padding: 8px 15px; background-color: #ffffff; border: 1px solid #57b269; color: #57b269; border-radius: 5px; text-decoration: none; font-size: 14px; font-weight: bold; transition: 0.3s;">
                                Xem chi tiết
                            </a>

                            @if ($order->status == 'unconfirm')
                                <form action="{{ route('Client.orders.cancel', [$order->order_code, $order->order_id]) }}"
                                    method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        style="padding: 8px 15px; background-color: #f44336; border: none; color: #ffffff; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer; transition: 0.3s;">
                                        Hủy đơn hàng
                                    </button>
                                </form>
                            @endif

                            @if ($order->status == 'delivered')
                                <form
                                    action="{{ route('Client.orders.confirmDelivered', [$order->order_code, $order->order_id]) }}"
                                    method="POST" onsubmit="return confirm('Bạn đã nhận đơn hàng này?')"
                                    style="display: inline-block;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit"
                                        style="padding: 8px 15px; background-color: #57b269; border: none; color: #ffffff; border-radius: 5px; font-size: 14px; font-weight: bold; cursor: pointer; transition: 0.3s;">
                                        Xác nhận đã nhận hàng
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-warning" role="alert"
                            style="padding: 15px; background-color: #fff3cd; color: #856404; border-radius: 5px; text-align: center;">
                            Không có đơn hàng nào.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>



    @endsection

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
