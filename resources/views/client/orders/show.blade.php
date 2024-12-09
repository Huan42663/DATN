@extends('client.master')
@section('title', 'Chi tiết đơn hàng')

@section('content')
    <!-- Nút quay lại -->
    <div style="margin: 20px 0 0 250px; display: flex; align-items: center; gap: 10px;">
        <a href="{{ route('Client.orders.list') }}"
            style="text-decoration: none; color: #0b2c50; font-weight: bold; transition: color 0.3s ease;"
            onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#007bff'">
            Danh sách đơn hàng
        </a>
        <span style="color: #6c757d;">/</span>
        <a href="#" style="text-decoration: none; color: #0e2e51; font-weight: bold; transition: color 0.3s ease;"
            onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#007bff'">
            Chi tiết đơn hàng
        </a>
    </div>

    <div
        style="display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; font-family: Arial, sans-serif; justify-content: center;">
        <div
            style="display: flex; flex-wrap: wrap; gap: 40px; padding: 20px; font-family: Arial, sans-serif; justify-content: center; flex: 1 1 70%;">
            <div
                style="flex: 1; max-width: 760px;  border: 1px solid #e0e0e0; border-radius: 8px; padding: 20px; background: #f8f9fa; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">

                <h2
                    style="text-align: center; font-size: 26px; font-weight: bold; color: #4caf50; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-bottom: 20px;">
                    Chi tiết đơn hàng
                </h2>

                <!-- Thông tin đơn hàng -->
                <div style="padding: 25px; line-height: 1.8; font-size: 16px; color: #555;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Mã đơn hàng:</strong> <span>{{ $order->order_code }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Ngày đặt:</strong>
                        <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Trạng thái:</strong>
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
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Phương thức thanh toán:</strong>
                        <span>{{ $order->method_payment }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Người nhận:</strong> <span>{{ $order->fullname }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Số điện thoại:</strong> <span>{{ $order->phone }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong style="color: #333;">Địa chỉ giao hàng:</strong> <span>{{ $order->address }}</span>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <h3
                    style="font-size: 22px; font-weight: bold; color: #333; margin-top: 30px; border-top: 2px solid #e0e0e0; padding-top: 10px; text-align: center;">
                    Danh sách sản phẩm
                </h3>
                <div class="product-list" style="display: flex; flex-direction: column; gap: 20px; margin-top: 20px;">

                    <div class="product-header"
                        style="display: grid; grid-template-columns: 5% 30% 15% 15% 15% 20%; font-size: 16px; font-weight: bold; color: #333; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-bottom: 10px; background-color: #f8f9fa; align-items: center;">
                        <span style="text-align: center; padding: 8px;">#</span>
                        <span style="text-align: left; padding-left: 10px;">Sản phẩm</span>
                        <span style="text-align: center;">Giá</span>
                        <span style="text-align: center;">Size</span>
                        <span style="text-align: center;">Màu</span>
                        <span style="text-align: center;">Số lượng</span>
                    </div>
                    @foreach ($order->orderDetail as $index => $detail)
                        <div class="product-item"
                            style="background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); padding: 20px; border: 1px solid rgba(0, 0, 0, 0.1); display: grid; grid-template-columns: 5% 30% 15% 15% 15% 20%; gap: 10px; align-items: center;">

                            <span style="text-align: center;">{{ $index + 1 }}</span>

                            <span style="text-align: left; padding-left: 10px;">
                                {{ $detail->product->product_name ?? 'Không tồn tại' }}
                            </span>

                            <span style="text-align: center;">
                                {{ number_format($detail->price, 0, ',', '.') }} đ
                            </span>

                            <span style="text-align: center;">{{ $detail->size ?? 'Không có' }}</span>
                            <span style="text-align: center;">{{ $detail->color ?? 'Không có' }}</span>
                            <span style="text-align: center;">{{ $detail->quantity }}</span>
                        </div>
                    @endforeach

                </div>

                <!-- Tổng Tiền -->
                <div
                    style="border: 1px solid #e0e0e0; padding: 15px; margin-top: 20px; background: #ffffff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); font-size: 16px; font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
                    <strong style="color: #333;">Tổng Tiền:</strong>
                    <span style="color: #f44336;">{{ number_format($order->total_discount, 0, ',', '.') }} đ</span>
                </div>

                <!-- Nút hành động -->
                <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                    <!-- Hủy đơn hàng -->
                    @if ($order->status == 'unconfirm')
                        <form action="{{ route('Client.orders.cancel', [$order->order_code, $order->order_id]) }}"
                            method="POST" onsubmit="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="cancleShow" value="cancleShow">
                            <button type="submit"
                                style="background-color: #ff5722; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">
                                Hủy Đơn Hàng
                            </button>
                        </form>
                    @endif

                    <!-- Xác nhận đã nhận hàng -->
                    @if ($order->status == 'delivered')
                        <form
                            action="{{ route('Client.orders.confirmDelivered', [$order->order_code, $order->order_id]) }}"
                            method="POST" onsubmit="return confirm('Bạn đã nhận đơn hàng này?')">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="delivereShow" value="delivereShow">
                            <button type="submit"
                                style="background-color: #10b848; color: white; padding: 10px 20px; font-size: 16px; border: none; border-radius: 5px; cursor: pointer; transition: background-color 0.3s;">
                                Xác Nhận Đã Nhận Hàng
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Phần bên phải: Bill hóa đơn -->
            <div
                style="flex: 1; max-width: 450px; border: 1px solid #e0e0e0; border-radius: 8px; padding: 25px; background: #ffffff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">
                <h2
                    style="text-align: center; font-size: 26px; font-weight: bold; color: #f44336; border-bottom: 2px solid #e0e0e0; padding-bottom: 10px; margin-bottom: 20px;">
                    Hóa đơn của bạn
                </h2>

                <div style="font-size: 16px; color: #333; line-height: 1.8;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Người nhận:</strong> <span>{{ $order->fullname }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Số điện thoại:</strong> <span>{{ $order->phone }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Địa chỉ giao hàng:</strong> <span>{{ $order->address }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Ngày đặt hàng:</strong> <span>{{ $order->created_at->format('d/m/Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Tổng tiền:</strong> <span>{{ number_format($order->total, 0, ',', '.') }} đ</span>
                    </div>
                </div>

                <div style="margin-top: 20px; border-top: 2px dashed #e0e0e0; padding-top: 20px; text-align: center;">
                    <p style="font-weight: bold; font-size: 18px; color: #007bff;">Cảm ơn bạn đã mua sắm tại cửa hàng của
                        chúng tôi!</p>
                </div>

                <!-- Thêm Thương Hiệu -->
                <div style="text-align: center; margin-top: 40px;">
                    <h1
                        style="font-size: 50px; color: #333; font-family: 'Georgia', serif; font-weight: 600; letter-spacing: 2px; 
                    text-transform: uppercase; 
                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                        JS STORE
                    </h1>
                    <p style="font-size: 18px; color: #555; font-style: italic; margin-top: 10px;">Chất lượng và uy tín cho
                        mọi sản phẩm</p>
                </div>

            </div>
        </div>

        <style>
            /* Thương hiệu với text-shadow nhẹ */
            @keyframes glowing {
                0% {
                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
                }

                50% {
                    text-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
                }

                100% {
                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
                }
            }

            h1 {
                animation: glowing 3s ease-in-out infinite;
            }
        </style>
    </div>
    {{-- Hỗ trợ  --}}
    <div
        style="position: fixed; bottom: 20px; right: 20px; z-index: 1000; cursor: pointer; font-family: Arial, sans-serif;">
        <!-- Biểu tượng hỗ trợ -->
        <div id="support-icon"
            style="background-color: #007bff; color: white; border-radius: 50%; padding: 18px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2); text-align: center; font-size: 20px; transition: background-color 0.3s ease;">
            <span style="font-size: 24px; line-height: 1;">📞</span>
        </div>

        <!-- Tooltip: Hiển thị số điện thoại khi hover -->
        <div id="tooltip"
            style="position: absolute; bottom: 60px; right: 0; background-color: rgba(0, 0, 0, 0.8); color: white; padding: 12px 20px; border-radius: 5px; display: none; font-size: 14px; z-index: 1001; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);">
            Liên hệ: <strong>0123456789</strong>
        </div>

        <!-- Popup: Hiển thị khi click vào biểu tượng -->
        <div id="popup"
            style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: #fff; border-radius: 8px; box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); padding: 40px; max-width: 450px; width: 90%; font-family: Arial, sans-serif; text-align: center; z-index: 1002; opacity: 0; transition: opacity 0.3s ease;">
            <h3 style="font-size: 22px; color: #333; margin-bottom: 20px;">Liên hệ hỗ trợ</h3>
            <p style="font-size: 18px; color: #555;">Liên hệ với chúng tôi để được hỗ trợ qua SĐT:</p>
            <p style="font-size: 20px; font-weight: bold; color: #007bff;">0123456789</p>
            <div style="margin-top: 30px;">
                <button id="close-popup"
                    style="background-color: #28a745; color: white; border: none; padding: 12px 24px; border-radius: 5px; cursor: pointer; font-size: 16px; transition: background-color 0.3s ease;">Đóng</button>
            </div>
        </div>
    </div>

    <script>
        // Hiển thị tooltip khi di chuột qua biểu tượng
        const supportIcon = document.getElementById('support-icon');
        const tooltip = document.getElementById('tooltip');

        supportIcon.addEventListener('mouseenter', () => {
            tooltip.style.display = 'block';
        });

        supportIcon.addEventListener('mouseleave', () => {
            tooltip.style.display = 'none';
        });

        // Hiển thị popup khi click vào biểu tượng
        supportIcon.addEventListener('click', () => {
            const popup = document.getElementById('popup');
            popup.style.display = 'block';
            setTimeout(() => {
                popup.style.opacity = '1'; // Hiệu ứng mờ dần
            }, 50);
        });

        // Đóng popup khi click vào nút đóng
        const closePopup = document.getElementById('close-popup');
        closePopup.addEventListener('click', () => {
            const popup = document.getElementById('popup');
            popup.style.opacity = '0';
            setTimeout(() => {
                popup.style.display = 'none'; // Ẩn popup sau khi hiệu ứng kết thúc
            }, 300);
        });

        // Thay đổi màu nền của biểu tượng khi hover
        supportIcon.addEventListener('mouseenter', () => {
            supportIcon.style.backgroundColor = '#0056b3';
        });

        supportIcon.addEventListener('mouseleave', () => {
            supportIcon.style.backgroundColor = '#007bff';
        });
    </script>


@endsection
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (đặt trước </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
