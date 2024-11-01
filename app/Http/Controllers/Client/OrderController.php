<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use App\Mail\OrderConfirmationMail;

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
        // Lấy tất cả đơn hàng từ cơ sở dữ liệu
        $orders = Order::all();

        // Trả về phản hồi dưới dạng JSON
        return response()->json([
            'message' => 'Danh sách tất cả đơn hàng',
            'data' => $orders,
        ], Response::HTTP_OK);
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
}

