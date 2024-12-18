

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thông tin đơn hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    <h1>Cảm ơn bạn đã đặt hàng, {{ $order->fullname }}!</h1>
    <p>Đây là chi tiết đơn hàng của bạn:</p>
    <p><strong>Mã đơn hàng: </strong> {{ $order->order_code }}</p>
    <p><strong>Địa chỉ giao hàng: </strong> {{ $order->address }}, {{ $order->street }},  {{ $order->ward }}, {{ $order->district }},{{ $order->province }} </p>
    <p><strong>Phương thức thanh toán: </strong> {{ $order->method_payment }}</p>
    <p><strong>Tổng giá trị đơn hàng: </strong> {{number_format($order->total, 0, ',', '.') . ' VNĐ' }}</p>
    <p><strong>Phí ship: </strong> 30.000 VND</p>
    @if($order->total > $order->total_discount && $order->total_discount != null)
    <p><strong>Tổng tiền cần thanh toán:</strong> {{number_format($order->total_discount, 0, ',', '.') . ' VNĐ' }}</p>
    @endif
    <p>
    @if($order->method_payment == "banking")    
        <span class="badge bg-soft-success text-success">Đã Thanh Toán</span>
    @endif
    </p>
    <a href="{{route('Client.orders.show',['order_code'=>$order->order_code,'order_id'=>$order->order_id])}}" style="color: #ffffff; background-color: #4CAF50; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Xem chi tiết tại đây</a>
    <p>Chúng tôi sẽ sớm liên hệ với bạn để xác nhận đơn hàng.</p>
    <p>Trân trọng,</p>
    <p>Đội ngũ của chúng tôi</p>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>