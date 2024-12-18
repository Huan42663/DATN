@extends('client.master')
@section('title', 'Chi tiết đơn hàng')

@section('content')
    <!-- Nút quay lại -->
    <div class="container mt-5" style=" display: flex; align-items: center; gap: 10px;">
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
                    style="text-align: center; font-size: 24px; font-weight: bold; color: #2c3e50; border-bottom: 2px solid #bdc3c7; padding-bottom: 15px;margin-top: 10px; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px;">
                    THÔNG TIN ĐƠN HÀNG
                </h2>

                <!-- Thông tin đơn hàng -->
                <div
                    style="font-size: 16px; color: #333; line-height: 1.8; max-width: 680px; margin: 20px auto; padding: 20px; border: 1px solid #dcdcdc; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background-color: #ffffff; font-family: Arial, sans-serif;">

                    <div style="margin: 20px;">
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Mã đơn hàng:</strong>
                            <span style="font-weight: bold;">{{ $order->order_code }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Ngày đặt:</strong>
                            <span>{{ $order->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Trạng thái:</strong>
                            <span style="font-weight: bold;" id="order_status">
                                @if ($order->status == 'unconfirm')
                                    <span
                                        style="color: #ff9800; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px;">Chờ
                                        Xác Nhận</span>
                                @elseif($order->status == 'confirmed')
                                    <span
                                        style="color: #008805; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đã
                                        Xác Nhận</span>
                                @elseif($order->status == 'shipping')
                                    <span
                                        style="color: #0059fe; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đang
                                        Vận Chuyển</span>
                                @elseif($order->status == 'delivered')
                                    <span
                                        style="color: #009cda; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đã
                                        Giao Đến Khách Hàng</span>
                                @elseif($order->status == 'received')
                                    <span
                                        style="color: #017e12; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px;">Đã
                                        Xác Nhận Nhận Hàng</span>
                                @elseif($order->status == 'canceled')
                                    <span
                                        style="color: #f44336; background-color: #fce4ec; padding: 5px 10px; border-radius: 5px;">Hủy
                                        Đơn </span>
                                @elseif($order->status == 'return')
                                    <span
                                        style="color: #565656; background-color: #eeeeee; padding: 5px 10px; border-radius: 5px;">Trả
                                        Hàng</span>
                                @endif
                            </span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Phương thức thanh toán:</strong>
                            <span>{{ $order->method_payment }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Người nhận:</strong>
                            <span>{{ $order->fullname }}</span>
                        </div>
                        <div
                            style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0; border-bottom: 1px solid #f1f1f1;">
                            <strong style="color: #555;">Số điện thoại:</strong>
                            <span>{{ $order->phone }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 15px; padding: 5px 0;">
                            <strong style="color: #555;">Địa chỉ giao hàng:</strong>
                            <span>{{ $order->address . ',' . $order->street . ', ' . $order->ward . ', ' . $order->district . ', ' . $order->province }}</span>
                        </div>
                    </div>
                </div>


                <!-- Danh sách sản phẩm -->
                <h3
                    style="font-size: 22px; font-weight: bold; color: #2c3e50; margin-top: 30px; border-top: 3px solid #bdc3c7; padding-top: 15px; text-align: center; text-transform: uppercase; letter-spacing: 1px;">
                    Danh sách sản phẩm
                </h3>

                <div class="product-list" style="margin-top: 20px;">

                    <!-- Tiêu đề danh sách -->
                    <div class="product-header"
                        style="display: grid; grid-template-columns: 5% 25% 25% 15% 10% 10% 10%; font-size: 16px; font-weight: bold; color: #ffffff; background-color: #476889; padding: 12px; border-radius: 8px;">
                        <span style="text-align: center;">#</span>
                        <span style="text-align: center;">Ảnh</span>
                        <span style="text-align: left; padding-left: 10px;">Sản phẩm</span>
                        <span style="text-align: center;">Giá</span>
                        <span style="text-align: center;">Size</span>
                        <span style="text-align: center;">Màu</span>
                        <span style="text-align: center;">Số lượng</span>
                    </div>

                    <!-- Danh sách sản phẩm -->
                    @foreach ($order->orderDetail as $index => $detail)
                        <div class="product-item"
                            style="display: grid; grid-template-columns: 5% 25% 25% 15% 10% 10% 10%; padding: 15px; background-color: #ffffff; border: 1px solid #bdc3c7; border-radius: 8px; margin-top: 10px; align-items: center; transition: all 0.3s ease; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                            <span style="text-align: center; color: #7f8c8d; font-weight: bold;">{{ $index + 1 }}</span>
                            <span style="text-align: center;">
                                <img width="100px" class="img-fluid"
                                    src="{{ asset('storage/' . $detail->product->product_image) }}"
                                    alt="{{ $detail->product->product_name ?? 'Không tồn tại' }}"
                                    style="max-width: 100px; border-radius: 4px;">
                            </span>
                            <span style="text-align: left; padding-left: 10px; font-weight: bold; color: #2c3e50;">
                                {{ $detail->product->product_name ?? 'Không tồn tại' }}
                            </span>
                            <span style="text-align: left; padding-left: 10px; font-size:14px;">
                                @if ($detail->sale_price != null || $detail->sale_price > 0)
                                    <span class="d-block text-danger"
                                        style="font-size:14px; font-weight: 700">{{ number_format($detail->sale_price, 0, ',', '.') . ' VNĐ' }}</span>
                                    <del
                                        class="text-secondary">{{ number_format($detail->price, 0, ',', '.') . ' VNĐ' }}</del>
                                @else
                                    <span
                                        class="d-block mb-1 text-danger">{{ number_format($detail->price, 0, ',', '.') . ' VNĐ' }}</span>
                                @endif
                            </span>
                            {{-- <span style="text-align: center;">
                                {{ number_format($detail->sale_price, 0, ',', '.') ." VNĐ"}} 
                            </span> --}}

                            <span style="text-align: center;">{{ $detail->size ?? 'Không có' }}</span>
                            <span style="text-align: center;">{{ $detail->color ?? 'Không có' }}</span>
                            <span style="text-align: center;">{{ $detail->quantity }}</span>
                            @php
                                $check = (new App\Models\Rate())
                                    ::query()
                                    ->join('products', 'rates.product_id', '=', 'products.product_id')
                                    ->leftJoin(
                                        'product_variant',
                                        'rates.product_variant_id',
                                        '=',
                                        'product_variant.product_variant_id',
                                    )
                                    ->leftJoin('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
                                    ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
                                    ->where('rates.order_id', $order->order_id)
                                    ->where('rates.product_id', $detail->product_id)
                                    ->where('sizes.size_name', $detail->size)
                                    ->where('colors.color_name', $detail->color)
                                    ->first();
                            @endphp

                        </div>

                        <a style="text-align: end" href="{{ route('Client.rate', ['product_id' => $detail->product_id, 'order_code' => $order->order_code]) }}"
                            class="mt-2 @if ($order->status != 'received' || $check != null) d-none @elseif($order->status == 'received' && $check == null) d-block @endif"
                            id="rate_check">
                            <button style="text-align: end" class="btn btn-primary" style=" width: 100px;">Đánh Giá</button>
                        </a>
                    @endforeach

                </div>


                <!-- Tổng Tiền -->

                <!-- Nút hành động -->
                <div style="display: flex; justify-content: space-between; margin-top: 30px;">
                    <input type="hidden" id="order_code" value="{{ $order->order_code }}">
                    <!-- Hủy đơn hàng -->
                    @if ($order->status == 'unconfirm')
                        <button type="button" id="cancel"
                            onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không')"
                            style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; background-color: #e74c3c; color: white; border-radius: 5px; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-align: center;">
                            Hủy đơn hàng
                        </button>
                    @endif

                    <!-- Xác nhận đã nhận hàng -->
                    @if ($order->status == 'delivered')
                        <button type="submit" id="confirm"
                            style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; background-color: #28a745; color: white; border-radius: 5px; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-align: center;">
                            Xác nhận đã nhận hàng
                        </button>
                        <button type="submit" id="return"
                            onclick="return confirm('Bạn có chắc muốn trả đơn hàng này không')"
                            style="width: 260px; max-width: 260px; padding: 10px 15px; font-size: 15px; background-color: black; color: white; border-radius: 5px; border: none; cursor: pointer; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-align: center;">
                            Trả hàng
                        </button>
                    @endif
                </div>
            </div>
            <script>
                $('#cancel').click(function() {
                    var order_code = $('#order_code').val();
                    const route = "{{ route('Client.orders.cancel') }}"
                    $.ajax({
                        url: route,
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            order_code: order_code,
                        },
                        dataType: "json",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: response.data,
                            }).then(() => {
                                $('#order_status').html(
                                    `<span style="color: #f44336; background-color: #fce4ec; padding: 5px 10px; border-radius: 5px;">Hủy Đơn </span>`
                                )
                                $('#cancel').addClass('d-none')
                                $('#return_banking').removeClass().addClass('d-block')
                                $('#payment_banking').removeClass().addClass('d-none')
                            });
                        },
                        error: function(error) {
                            swal({
                                icon: "error",
                                title: error.responseJSON.data,
                            });

                            if (error.responseJSON.order_status == 'unconfirm') {
                                $('#order_status').html(
                                    `style="color: #ff9800; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px;">Chờ Xác Nhận</span>`
                                )
                            } else if (error.responseJSON.order_status == 'confirmed') {
                                $('#order_status').html(
                                    ` <span style="color: #008805; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đã Xác Nhận</span>`
                                )
                                $('#cancel').addClass('d-none')
                            } else if (error.responseJSON.order_status == 'shipping') {
                                $('#order_status').html(
                                    ` <span style="color: #0059fe; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đang Vận Chuyển</span>`
                                )
                                $('#cancel').addClass('d-none')
                            } else if (error.responseJSON.order_status == 'delivered') {
                                $('#order_status').html(
                                    `<span style="color: #009cda; background-color: #e8f5e9; padding: 5px 10px; border-radius: 5px;">Đã Giao Đến Khách Hàng</span>`
                                )
                                $('#cancel').addClass('d-none')
                                $('#confirm').removeClass().addClass('d-block')
                                $('#return').removeClass().addClass('d-block')
                            } else if (error.responseJSON.order_status == 'received') {
                                $('#order_status').html(
                                    `<span style="color: #73ff00; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px;">Đã Xác Nhận Nhận Hàng</span>`
                                )
                                $('#cancel').addClass('d-none')
                            } else if (error.responseJSON.order_status == 'canceled') {
                                $('#order_status').html(
                                    `<span style="color: #f44336; background-color: #fce4ec; padding: 5px 10px; border-radius: 5px;">Hủy Đơn </span>`
                                )
                            } else if (error.responseJSON.order_status == 'return') {
                                $('#order_status').html(
                                    ` <span style="color: #565656; background-color: #eeeeee; padding: 5px 10px; border-radius: 5px;">Trả Hàng</span>`
                                )
                                $('#cancel').addClass('d-none')
                            }


                        }
                    });

                });

                $('#confirm').click(function() {
                    var order_code = $('#order_code').val();
                    const route = "{{ route('Client.orders.confirmDelivered') }}"
                    $.ajax({
                        url: route,
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            order_code: order_code,
                        },
                        dataType: "json",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: response.data,
                            }).then(() => {
                                $('#order_status').html(
                                    `<span style="color: #017e12; background-color: #fff3cd; padding: 5px 10px; border-radius: 5px;">Đã Xác Nhận Nhận Hàng</span>`
                                )
                                $('#confirm').addClass('d-none')
                                $('#return').addClass('d-none')
                                var elements = document.querySelectorAll('#rate_check');
                                elements.forEach(element => {
                                    element.classList.remove('d-none');
                                    element.classList.add('d-block');
                                });

                            });
                        },
                        error: function(error) {
                            swal({
                                icon: "error",
                                title: error.responseJSON.data,
                            })
                        }
                    });

                });

                $('#return').click(function() {
                    var order_code = $('#order_code').val();
                    const route = "{{ route('Client.orders.return') }}"
                    $.ajax({
                        url: route,
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            order_code: order_code,
                        },
                        dataType: "json",
                        success: function(response) {
                            swal({
                                icon: "success",
                                title: response.data,
                            }).then(() => {
                                $('#order_status').html(
                                    `<span style="color: #565656; background-color: #eeeeee; padding: 5px 10px; border-radius: 5px;">Trả Hàng</span>`
                                )
                                $('#confirm').addClass('d-none')
                                $('#return').addClass('d-none')
                                $('#return_banking').removeClass().addClass('d-block')
                                $('#payment_banking').removeClass().addClass('d-none')
                            });
                        },
                        error: function(error) {
                            swal({
                                icon: "error",
                                title: error.responseJSON.data,
                            })
                        }
                    });

                });
            </script>
            <!-- Phần bên phải: Bill hóa đơn -->
            <div
                style="flex: 1; max-width: 450px; border: 1px solid #dcdcdc; border-radius: 10px; padding: 30px; background: #ffffff; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
                <h2
                    style="text-align: center; font-size: 24px; font-weight: bold; color: #2c3e50; border-bottom: 2px solid #bdc3c7; padding-bottom: 15px; margin-bottom: 25px; text-transform: uppercase; letter-spacing: 1px;">
                    Hóa đơn của bạn
                </h2>

                <div
                    style="margin-top: 20px; padding: 20px; border: 2px solid #e0e0e0; border-radius: 12px; background-color: #fafafa; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <!-- Thông tin người nhận -->
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <strong style="color: #444;">Người nhận:</strong>
                        <span>{{ $order->fullname }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <strong style="color: #444;">Số điện thoại:</strong>
                        <span>{{ $order->phone }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <strong style="color: #444;">Địa chỉ giao hàng:</strong>
                        <span>{{ $order->address }}</span>
                    </div>

                    <!-- Chi tiết thanh toán -->
                    @php
                        $ship = 0;
                        $giamGia = 0;
                        if (isset($order)) {
                            $ship = 30000;
                            $giamGia = $order->total - $order->total_discount;
                        }
                    @endphp
                   
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Ngày đặt hàng:</strong> <span>{{ $order->created_at }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Tổng giá trị sản
                            phẩm:</strong><span>{{ number_format($order->total - 30000, 0, ',', '.') . ' VNĐ' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Phí vận chuyển:</strong><span>{{ number_format(30000, 0, ',', '.') . ' VNĐ' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Khuyến
                            mãi:</strong><span>{{ number_format($order->total - $order->total_discount, 0, ',', '.') . ' VNĐ' }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                        <strong>Tổng Tiền:</strong>
                        @if ($order->total > $order->total_discount && $order->total_discount != null)
                            <span
                                class="text-danger">{{ number_format($order->total_discount, 0, ',', '.') . ' VNĐ' }}</span>
                        @else
                            <span class="text-danger">{{ number_format($order->total, 0, ',', '.') . ' VNĐ' }}</span>
                        @endif
                    </div>

                    @if ($orderBill != null)
                    <div style="height: 1px; background-color: #ddd; margin-bottom: 10px;"></div>
                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;" class="mt-1">
                        <strong class="fs-bold fw-5">Thông tin giao dịch</strong>
                    </div>
                    
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Mã ngân hàng:</strong><span>{{ $orderBill->bank_code }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Mã giao dịch:</strong><span>{{ $orderBill->bank_tranno }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Số tiền giao
                                dịch:</strong><span>{{ number_format($orderBill->amount, 0, ',', '.') . ' VNĐ' }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Loại thẻ:</strong><span>{{ $orderBill->card_type }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Mã giao dịch VnPay:</strong><span>{{ $orderBill->vnpay_transactionno }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Thời gian giao dịch</strong><span>{{ $orderBill->created_at }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                            <strong>Tổng Tiền Cần Thu:</strong>
                            <span class="text-danger"> 0 VNĐ</span>
                        </div>
                        @if ($order->method_payment == 'banking')
                            <div style="display: flex; justify-content: end; margin-bottom: 10px;" class="d-none"
                                id="return_banking">
                                <span class="badge bg-soft-danger text-danger fs-6">Đã Hoàn Trả</span>
                            </div>
                            <div style="display: flex; justify-content: end; margin-bottom: 10px;"
                                class="d-block"id="payment_banking">
                                <span class="badge bg-soft-success text-success fs-6">Đã Thanh Toán</span>
                            </div>
                        @endif
                    @endif

                </div>

                <!-- Thông điệp cảm ơn -->
                <div style="margin-top: 20px; text-align: center; border-top: 1px solid #dcdcdc; padding-top: 20px;">
                    <p style="font-weight: bold; font-size: 18px; color: #16a085;">Cảm ơn bạn đã mua sắm tại cửa hàng của
                        chúng tôi!</p>
                </div>

                <!-- Thương hiệu -->
                <div style="text-align: center; margin-top: 30px;">
                    <h1
                        style="font-size: 50px; color: #333; font-family: 'Georgia', serif; font-weight: 600; letter-spacing: 2px; 
                    text-transform: uppercase; 
                    text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);">
                        JSTORE
                    </h1>
                    <p style="font-size: 16px; color: #7f8c8d; font-style: italic;">Chất lượng và uy tín cho mọi sản phẩm
                    </p>
                </div>
            </div>

        </div>
        @if (session('message'))
            <input type="hidden" id="messagecheck" value="{{ session('message') }}">
        @endif
        @if (session('status'))
            <input type="hidden" id="statuscheck" value="{{ session('status') }}">
        @endif
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
        const check = document.getElementById('messagecheck');
        const check1 = document.getElementById('statuscheck');

        if (check != null && check1 != null) {
            if (check1.value == "false") {
                swal({
                    icon: "error",
                    title: check.value,
                });
            } else {
                swal({
                    icon: "success",
                    title: check.value,
                });
            }
        }

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
{{-- <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS (đặt trước </body>) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script> --}}
