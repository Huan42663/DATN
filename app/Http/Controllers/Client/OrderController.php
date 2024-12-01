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
use Carbon\Carbon;
use App\Models\Voucher;
use App\Models\OrderDetail;
use App\Models\CartDetail;
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
    public function orderCart(Request $request){
        $data = explode(', ', $request->product[0]);
        $voucher = Voucher::where('date_end','>=',Carbon::now())->where('date_start','<=',Carbon::now())->where('quantity','>',0)->get();
        $cart = new CartController();
        $data1 = $cart->showCart(Auth()->user()->user_id);
        // dd($data1["Cart"]);
        return View('client.orders.createOrder',compact('data','data1','voucher'));
    }

    public function store(Request $request)
    {
       
        if(isset($request->voucher)){
            $data = Voucher::where('voucher_code',$request->voucher_code)->where('date_end','>=',Carbon::now())->where('date_start','<=',Carbon::now())->get();
            $_SESSION['dataInfo'] = $request->except('_token','voucher_code','voucher');
            if(count($data) >0){
                if($data[0]->quantity > 0){
                    $_SESSION['voucher'] = $data;
                }
                return redirect()->back();
            }else{
                unset($_SESSION['voucher']);
                return redirect()->back()->with('error','Mã khuyến mãi này không tồn tại hoặc đã hết số lượng dùng');
            }
        }
        else{
            unset($_SESSION['dataInfo']);
            $request->validate([
                    'fullname' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'method_payment' => 'required',
                    'note' => 'max:255',
                    'address' => 'required|string|max:255',
                    'province' => 'required',
                    'district' => 'required',
                    'ward' => 'required',
                    'street' => 'required|max:50',
            ],
                 [
                    'fullname.required' => 'Họ và tên không được để trống',
                    'method_payment.required' => 'Vui lòng chọn phương thức thanh toán',
                    'fullname.max' => 'Họ và tên không được quá 255 kí tự',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email không đúng định dạng',
                    'email.max' => 'Email không được quá 255 kí tự',
                    'note.max' => 'Note không được quá 255 kí tự',
                    'address.required' => 'Địa chỉ không được để trống',
                    'address.max' => 'Địa chỉ không được quá 255 kí tự',
                    'province.required' => 'Tỉnh/Thành Phố không được để trống',
                    'district.required' => 'Quận/Huyện không được để trống',
                    'ward.required' => 'Phường\Xã không được để trống',
                    'street.required' => 'Đường không được để trống',
                    'street.max' => 'Đường  không được quá 50 kí tự',
                ]
        
        );

        $data1 = [
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'total'=>$request->total,
            'total_discount'=>$request->total_discount,
            'method_payment'=>$request->method_payment,
            'user_id'=>Auth()->user()->user_id,
            'note'=>$request->note,
            'address'=>$request->address,
            'province'=>$request->province,
            'district'=>$request->district,
            'ward'=>$request->ward,
            'street'=>$request->street,
            'hamlet'=>"",
            'status'=>"unconfirm"
        ];

        if($request->method_payment != "banking"){
            $order = Order::create($data1);
            $order_code = "jsstore24".rand(1000000,9999999).$order->order_id;
            $data1['order_code'] = $order_code;
            $order->update($data1);
        }
        $cart = new CartController();
        $data = $cart->showCart(Auth()->user()->user_id);
        $i=0;
        foreach($data['Cart'] as $item){
            foreach($request->cart_detail_id as $item1){
                if($item->cart_detail_id == $item1){
                    $data2 = 
                    [
                        'order_id' =>$order->order_id,
                        'product_id'=>$item->product_id,
                        'size' =>$item->size,
                        'color' =>$item->color,
                        'price' =>$item->price,
                        'sale_price' =>$item->sale_price,
                        'quantity' =>$item->quantity
                    ];
                    OrderDetail::create($data2);
                    CartDetail::where('cart_detail_id',$item->cart_detail_id)->delete();
                }
            }
        }
           return redirect()->route('Client.Home');
        }

        // $order = Order::create($validatedData);

        // // Gửi email xác nhận đơn hàng
        // Mail::to($order->email)->send(new OrderConfirmationMail($order));

        // // Trả về phản hồi cho API
        // return response()->json([
        //     'message' => 'Đơn hàng đã được thêm và email xác nhận đã được gửi!',
        //     'order' => $order
        // ], 201);
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
