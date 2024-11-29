<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use App\Mail\OrderConfirmationMail;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Lưu đơn hàng và gửi email xác nhận.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        if (!auth()->check()) {
            return redirect()->route('Client.account.showLoginForm')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        }
        $userId = Auth()->user()->user_id;
        $orders = Order::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.orders.index', compact('orders'));
    }

    public function show($order_code, $order_id)
    {
        $order = Order::query()
            ->where('order_code', $order_code)
            ->where('order_id', $order_id)
            ->with(['orderDetail.product', 'orderDetail.size', 'orderDetail.color'])
            ->first();
        return view('client.orders.show', compact('order'));
    }



    public function store(Request $request)
    {
        // Validate dữ liệu từ request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'fullname' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:orders,email',
            'phone' => 'required|string|max:11|unique:orders,phone',
            'total' => 'required|numeric',
            'total_discount' => 'nullable|numeric',
            'method_payment' => 'required|in:COD,banking',
            'order_code' => 'required|string|max:50',
            'note' => 'nullable|string|max:255',
            'address' => 'required|string|max:255',
            'province' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'ward' => 'required|string|max:50',
            'street' => 'required|string|max:50',
            'hamlet' => 'nullable|string|max:50',

        ]);
        $emailExists = Order::where('email', $request->email)->exists();

        if ($emailExists) {
            return response()->json([
                'message' => 'Email đã tồn tại trong hệ thống đơn hàng!',
            ], 422);
        }

        // Tạo đơn hàng
        $order = Order::create($validatedData);

        // Gửi email xác nhận đơn hàng
        Mail::to($order->email)->send(new OrderConfirmationMail($order));

        // Trả về phản hồi cho API
        return response()->json([
            'message' => 'Đơn hàng đã được thêm và email xác nhận đã được gửi!',
            'order' => $order
        ], 201);
    }

    // Xử lý đơn hàng

    public function cancel(Request $request, $order_code, $order_id)
    {
        $order = Order::where('order_code', $order_code)->where('order_id', $order_id)->firstOrFail();
        if ($order->status == 'unconfirm') {
            $order->status = 'canceled';
            $order->save();
            if (isset($request->cancleShow)) {
                return redirect()->route('Client.orders.show', [$order_code, $order_id])->with('massage', 'Đơn hàng đã được hủy thành công!');
            }
            return redirect()->route('Client.orders.list')->with('massage', 'Đơn hàng đã được hủy thành công!');
        }

        return redirect()->route('Client.orders.list')->with('error', 'Không thể hủy đơn hàng này!');
    }

    public function confirmDelivered(Request $request, $order_code, $order_id)
    {
        $order = Order::where('order_code', $order_code)->where('order_id', $order_id)->firstOrFail();

        if ($order->status == 'delivered') {
            $order->status = 'received';
            $order->save();
            if (isset($request->delivereShow)) {
                return redirect()->route('Client.orders.show', [$order_code, $order_id])->with('massage', 'Đơn hàng đã giao thành công!');
            }
            return redirect()->route('Client.orders.list')->with('massage', 'Đơn hàng đã giao thành công!');
        }
        return redirect()->route('Client.orders.list');
    }
   
}
