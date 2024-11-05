<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận đơn hàng</title>
</head>
<body>
    <h1>Cảm ơn bạn đã đặt hàng, {{ $order->fullname }}!</h1>
    <p>Đây là chi tiết đơn hàng của bạn:</p>
    <p><strong>Mã đơn hàng:</strong> {{ $order->order_code }}</p>
    <p><strong>Địa chỉ giao hàng:</strong> {{ $order->address }}, {{ $order->province }}, {{ $order->district }}, {{ $order->ward }}, {{ $order->street }}</p>
    <p><strong>Phương thức thanh toán:</strong> {{ $order->method_payment }}</p>
    <p><strong>Tổng giá trị đơn hàng:</strong> {{ $order->total }} VND</p>
    <p>Chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ của chúng tôi</p>
</body>
</html>
