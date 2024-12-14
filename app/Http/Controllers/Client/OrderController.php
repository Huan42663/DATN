<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Response;
use App\Mail\OrderConfirmationMail;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Voucher;
use App\Models\Bill;
use App\Models\Rate;
use App\Models\Cart;
use App\Models\RateImage;
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
    public function __construct()
    {
        $Voucher = Voucher::query()->get();
        $date = Carbon::now();
        $data['quantity'] = 0;
        foreach ($Voucher as $key) {
            if($key->quantity != 0){
                if ($key->date_end == $date || $key->date_end < $date) {
                    Voucher::query()->where('voucher_id', $key->voucher_id)->update($data);
                }
            }
        }
        unset($_SESSION['thankyou']);
        // unset($_SESSION['order_code']);
    }
    public function vnpay_payment(){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $_SESSION['thankyou'] = "Dặt hàng thành công";
        $full_url = "http://" . $_SERVER['HTTP_HOST'];
        $vnp_Returnurl = $full_url;
        $vnp_TmnCode = "KOFSYQXY";//Mã website tại VNPAY 
        $vnp_HashSecret = "UO4KD2T4UW40OS06GPZTCYD58Z15PU4P"; //Chuỗi bí mật
        
        // $vnp_TxnRef = $_POST['order_id']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_TxnRef = $_SESSION['infoOrder']['order_code']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "thanh toán đơn hàng test";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $_SESSION['infoOrder']['total_discount'] * 100;
        $vnp_Locale = "vn";
        $vnp_BankCode = "NCB";
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        //Add Params of 2.0.1 Version
        // $vnp_ExpireDate = $_POST['txtexpire'];
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef
            // "vnp_ExpireDate"=>$vnp_ExpireDate,
            // "vnp_Bill_Mobile"=>$vnp_Bill_Mobile,
            // "vnp_Bill_Email"=>$vnp_Bill_Email,
            // "vnp_Bill_FirstName"=>$vnp_Bill_FirstName,
            // "vnp_Bill_LastName"=>$vnp_Bill_LastName,
            // "vnp_Bill_Address"=>$vnp_Bill_Address,
            // "vnp_Bill_City"=>$vnp_Bill_City,
            // "vnp_Bill_Country"=>$vnp_Bill_Country,
            // "vnp_Inv_Phone"=>$vnp_Inv_Phone,
            // "vnp_Inv_Email"=>$vnp_Inv_Email,
            // "vnp_Inv_Customer"=>$vnp_Inv_Customer,
            // "vnp_Inv_Address"=>$vnp_Inv_Address,
            // "vnp_Inv_Company"=>$vnp_Inv_Company,
            // "vnp_Inv_Taxcode"=>$vnp_Inv_Taxcode,
            // "vnp_Inv_Type"=>$vnp_Inv_Type
        );
        
        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }
        
        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }
        
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                header('Location: ' . $vnp_Url);
                die();
                // echo json_encode($returnData);
            }
            // vui lòng tham khảo thêm tại code demo
    }
    public function index()
    {
        // if (!auth()->check()) {
        //     return redirect()->route('Client.account.showLoginForm')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        // }
        $userId = auth()->user()->user_id;
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
        $rate = Rate::query()->where('order_id',$order_id)
        ->join('products','rates.product_id','products.product_id')
        ->leftJoin('product_variant','rates.product_variant_id','product_variant.product_variant_id')
        ->leftJoin('sizes','product_variant.size_id','=','sizes.size_id')
        ->leftJoin('colors','product_variant.color_id','=','colors.color_id')
        ->get();
        $orderBill = Bill::query()->where('order_id',$order_id)->first();
        // dd($order);
        return view('client.orders.show', compact('order','orderBill','rate'));
    }

    public function orderCart1(Request $request)
    {
        // dd($request->all());
        if(!isset($request->product_id)){
            return response()->json(['data'=>"Vui lòng chọn sản phẩm"],Response::HTTP_BAD_REQUEST);
        }
        $data = explode(', ', $request->product_id);
        $product_variant = ProductVariant::query()->get();
        $voucher = Voucher::where('date_end', '>=', Carbon::now())->where('date_start', '<=', Carbon::now())->where('quantity', '>', 0)->get();
        $cart = new CartController();
        $data1 = $cart->showCart(Auth()->user()->user_id);
        foreach ($data as  $value) {
            $product = CartDetail::where('cart_detail_id', $value)->get();
            if (!count($product) > 0) {
                return response()->json(['data'=>"Sản Phẩm Bạn chọn không tồn tại trong giỏ hàng vui lòng kiểm tra lại",'route'=>"reload"],404);
            }
            foreach($product_variant as $item){
                $check = ProductVariant::where('product_variant_id',$product[0]->product_variant_id)->get();
                if($product[0]->quantity > $check[0]->quantity){
                    $update = CartDetail::where('product_variant_id', $product[0]->product_variant_id)->get();
                    foreach($update as $checkupdate){
                        $checkupdate->quantity =$check[0]->quantity;
                        $checkupdate->save();
                    }
                    return response()->json(['data'=>"Số lượng sản phẩm bạn muốn đặt hàng đã vượt quá số lượng của chúng tôi có là" .$check[0]->quantity,'route'=>"reload"],404);
                }
            }
        }
        $_SESSION['cart'] = $data;
        return response()->json(['data'=>"status true"],200);
    }
    public function orderCart()
    {
        $data = $_SESSION['cart'];
        $product_variant = ProductVariant::query()->get();
        $voucher = Voucher::where('date_end', '>=', Carbon::now())->where('date_start', '<=', Carbon::now())->where('quantity', '>', 0)->get();
        $cart = new CartController();
        $data1 = $cart->showCart(Auth()->user()->user_id);
        return View('client.orders.createOrder', compact('data', 'data1', 'voucher'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
            $_SESSION['dataInfo'] = $request->except('_token', 'voucher_code', 'voucher');
            $request->validate(
                [
                    'fullname' => 'required|max:255',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|max:11',
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
                    'fullname.max' => 'Họ và tên không được quá 255 kí tự',
                    'method_payment.required' => 'Vui lòng chọn phương thức thanh toán',
                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email không đúng định dạng',
                    'email.max' => 'Email không được quá 255 kí tự',
                    'phone.required' => 'Số điện thoại không được để trống',
                    'phone.max' => 'Số không đúng định dạng',
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
            if (!$this->ValidateText($request->fullname)) {
                return redirect()->back()->with('fullname', 'Họ tên không đúng định dạng');
            }
            if (!$this->ValidateText($request->street)) {
                return redirect()->back()->with('street', 'Đường không đúng định dạng');
            }
            if (!$this->ValidateText($request->address)) {
                return redirect()->back()->with('address', 'Địa Chỉ không đúng định dạng');
            }
            if (!empty($request->note) && !$this->ValidateText($request->note)) {
                return redirect()->back()->with('note', 'Note không đúng định dạng');
            }
            $pattern = '/^(0|\+84|\+841|\+849|\+8498)([2-9]\d{8})$/';
            if (!preg_match($pattern, $request->phone)) {
                return redirect()->back()->with('phone', 'Số điện thoại không đúng định dạng');
            }
            // dd($request->all());

            $data1 = [
                'fullname' => $request->fullname,
                'email' => $request->email,
                'phone' => $request->phone,
                'total' => $request->total,
                'total_discount' => $request->total_discount,
                'method_payment' => $request->method_payment,
                'user_id' => Auth()->user()->user_id,
                'note' => $request->note,
                'address' => $request->address,
                'province' => $request->province,
                'district' => $request->district,
                'ward' => $request->ward,
                'street' => $request->street,
                'hamlet' => "",
                'status' => "unconfirm"
            ];
            // $_SESSION['infoOrder'] = $data1;
            // dd($_SESSION['infoOrder']);
            if(isset($_SESSION['voucher'])){
                if($_SESSION['voucher']->quantity == 0 ||  $_SESSION['voucher']->date_start <= Carbon::now() ||  $_SESSION['voucher']->date_end >=Carbon::now()  ){
                    unset($_SESSION['voucher']);
                    return redirect()->back()->with('error_voucher12','Voucher không khả dụng');
                } 
            }
            $cart = new CartController();
            $data = $cart->showCart(Auth()->user()->user_id);
            $_SESSION['listCart'] = $data['Cart'];
            $cart = Cart::where('user_id',Auth()->user()->user_id)->first();
            foreach ($request->cart_detail_id as $item1) {
                $check = CartDetail::where('cart_detail_id', $item1)->where('cart_id',$cart->cart_id)->first();
                if($check == null){
                    return redirect()->route('Client.cart.list')->with('error','Sản phẩm của bạn vừa đặt không tồn tại');
                }
            }
            if ($request->method_payment != "banking") {
                $order = Order::create($data1);
                $order_code = "jstore24" . rand(1000000, 9999999) . $order->order_id;
                $data1['order_code'] = $order_code;
                $order->update($data1);
                foreach ($data['Cart'] as $item) {
                    foreach ($_SESSION['cart'] as $item1) {
                        if ($item->cart_detail_id == $item1) {
                            $data2 =
                                [
                                    'order_id' => $order->order_id,
                                    'product_id' => $item->product_id,
                                    'size' => $item->size,
                                    'color' => $item->color,
                                    'price' => $item->price,
                                    'sale_price' => $item->sale_price,
                                    'quantity' => $item->quantity
                                ];
                            OrderDetail::create($data2);
                            CartDetail::where('cart_detail_id', $item->cart_detail_id)->delete();
                            $product_variant = ProductVariant::query()->where('product_id', $item->product_id)->where('size_id', $item->size_id)->where('color_id', $item->color_id)->get();
                            $quantity = $product_variant[0]->quantity - $item->quantity;
                            $dataUpdate = ['quantity' => $quantity];
                            ProductVariant::query()->where('product_id', $item->product_id)->where('size_id', $item->size_id)->where('color_id', $item->color_id)->update($dataUpdate);
                        }
                    }
                }
                if (isset($_SESSION['voucher'])) {
                    $voucherUse = Voucher::query()->where('voucher_id', $_SESSION['voucher']->voucher_id)->get();
                    $quantityVoucher = $voucherUse[0]->quantity - 1;
                    $dataVoucherUpdate = ['quantity' => $quantityVoucher];
                    Voucher::query()->where('voucher_id', $_SESSION['voucher']->voucher_id)->update($dataVoucherUpdate);
                    unset($_SESSION['voucher']);
                }
                $email = $order->email;
                Mail::send('emails.order_confirmation', ['order' => $order], function ($message) use ($email) {
                    $message->to($email);
                    $message->subject('Thông tin đơn hàng');
                });

                $_SESSION['thankyou'] = "Dặt hàng thành công";
                unset($_SESSION['dataInfo']);
                return redirect()->route('Client.orders.thank');
            }else{
                $order = Order::all();
                $order_code = "jsstore24" . rand(1000000, 9999999);
                foreach($order as $item){
                   $check = Order::where('order_code',$order_code)->first();
                   if($check == null){
                        $data1['order_code'] = $order_code;
                        break;
                   }
                }
                $_SESSION['infoOrder'] = $data1;
                return redirect()->route('Client.orders.vnpay_payment');
            }
            
            
        }

    public function thank(){
        $products = Products::query()
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->where('products.status', 1)
                ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Max(product_variant.sale_price) as minPrice')
                ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                ->orderBy('products.product_id', 'desc')
                ->limit(8)
                ->get();
            
        return View('client.thankyou',compact('products'));
    }

    // Xử lý đơn hàng
    public function voucher(Request $request){
        if(isset($request->voucher_code)){
            $data = Voucher::where('voucher_code', $request->voucher_code)->where('date_end', '>=', Carbon::now())->where('date_start', '<=', Carbon::now())->first();
            if ($data != null) {
                if ($data->quantity > 0) {
                    $_SESSION['voucher'] = $data;
                    return response()->json(["data"=>"Áp dụng thành công",'value'=> $_SESSION['voucher']],Response::HTTP_OK);  
                }
                return response()->json(["data"=>"Không tồn tại voucher","status"=>false],Response::HTTP_NOT_FOUND); 
            } else {
                unset($_SESSION['voucher']);
                return response()->json(["data"=>"Không tồn tại voucher","status"=>false],Response::HTTP_NOT_FOUND); 
            }
        }else{
            return response()->json(["data"=>"Không tồn tại voucher","status"=>false],Response::HTTP_NOT_FOUND); 
        }
    }
    public function cancel(Request $request)
    {
        $order = Order::where('order_code', $request->order_code)->firstOrFail();
        if(isset($order)){
            if ($order->status == 'unconfirm') {
                $order->status = 'canceled';
                $order->save();
                $ordercheck = Order::join('order_detail','orders.order_id','=','order_detail.order_id')->where('order_code', $request->order_code)->firstOrFail();

                $orderReturn = Order::join('order_detail','orders.order_id','=','order_detail.order_id')
                            ->join('products','order_detail.product_id','=','products.product_id')
                            ->join('product_variant','products.product_id','=','product_variant.product_id')
                            ->leftJoin('sizes','product_variant.size_id','=','sizes.size_id')
                            ->leftJoin('colors','product_variant.color_id','=','colors.color_id')
                            ->where('orders.order_code',$ordercheck->order_code)
                            ->where('products.product_id',$ordercheck->product_id)
                            ->where('sizes.size_name',$ordercheck->size)
                            ->where('colors.color_name',$ordercheck->color)
                            ->select('product_variant.*','order_detail.quantity as orderQuantity')
                            ->get();
                $productVariant = ProductVariant::where('product_variant_id',$orderReturn[0]->product_variant_id)->get();
                $data = ['quantity'=>$orderReturn[0]->orderQuantity + $productVariant[0]->quantity ];
                ProductVariant::where('product_variant_id',$orderReturn[0]->product_variant_id)->update($data);
                if (isset($request->cancleShow)) {
                    return response()->json(["data"=>"Hủy đơn hàng thành công",'status'=> true],Response::HTTP_OK);  
                }
                return response()->json(["data"=>"Hủy đơn hàng thành công",'status'=> true],Response::HTTP_OK);  
            }
            else{
                return response()->json(["data"=>"Đơn Hàng đã ở trạng thái khác không thể hủy",'status'=> true,'order_status'=>$order->status],Response::HTTP_BAD_REQUEST); 
            }
        }else{
            return response()->json(["data"=>"Không tìm thầy đơn hàng",'status'=> false],Response::HTTP_NOT_FOUND);  
        }

    }

    public function confirmDelivered(Request $request)
    {

        $order = Order::where('order_code', $request->order_code)->firstOrFail();
        if(isset($order)){
            if ($order->status == 'delivered') {
                $order->status = 'received';
                $order->save();
                    return response()->json(["data"=>"Bạn đã xác nhận đơn hàng thành công",'status'=> true],Response::HTTP_OK);   
            }
            else{
                return response()->json(["data"=>"Đơn Hàng đã ở trạng thái khác nên bạn chưa xác nhận được",'status'=> true,'order_status'=>$order->status,'check'=>$order],Response::HTTP_BAD_REQUEST); 
            }
        }else{
            return response()->json(["data"=>"Không tìm thầy đơn hàng",'status'=> false],Response::HTTP_NOT_FOUND);  
        }

    }
    public function return(Request $request)
    {

        $order = Order::where('order_code', $request->order_code)->firstOrFail();
        if(isset($order)){
            if ($order->status == 'delivered') {
                $order->status = 'return';
                $order->save();
                    return response()->json(["data"=>"Bạn đã xác nhận trả hàng",'status'=> true],Response::HTTP_OK);   
            }
            else{
                return response()->json(["data"=>"Đơn Hàng đã của bạn chưa được giao tới nên chưa trả hàng được",'status'=> false,'order_status'=>$order->status,'check'=>$order],Response::HTTP_BAD_REQUEST); 
            }
        }else{
            return response()->json(["data"=>"Không tìm thầy đơn hàng",'status'=> false],Response::HTTP_NOT_FOUND);  
        }

    }
    public function rates(string $product_id,string $order_code){
            $_SESSION['order_code'] = $order_code;
            $product = OrderDetail::query()
                       ->join('orders','order_detail.order_id','=','orders.order_id')
                       ->join('products','order_detail.product_id','=','products.product_id')
                       ->leftJoin('sizes','order_detail.size','=','sizes.size_name')
                       ->leftJoin('colors','order_detail.color','=','colors.color_name')
                       ->where('order_detail.product_id',$product_id)
                       ->where('orders.order_code',$order_code)
                    //    ->where('orders.user_id',1)  
                       ->where('orders.user_id',Auth::user()->user_id)
                       ->selectRaw('products.*,order_detail.*,orders.order_id')
                       ->first();
            if($product != null){
                $productCheck = ProductVariant::leftJoin('sizes','product_variant.size_id','=','sizes.size_id')
                                ->leftJoin('colors','product_variant.color_id','=','colors.color_id')
                                ->where('product_variant.product_id',$product->product_id)
                                ->where('sizes.size_name',$product->size)
                                ->where('colors.color_name',$product->color)
                                ->first();
            }else{
                return redirect()->back();
            }

        $rate = Rate::query()->where('order_id', $product->order_id)->where('product_id', $product->product_id)->where('product_variant_id', $productCheck->product_variant_id)->first();

        if ($product != null) {
            if ($rate == null) {
                $_SESSION['Rate'] = $product;
                $_SESSION['Rate']['product_variant_id'] = $productCheck->product_variant_id;
                return View('client.rate', compact('product'));
            } else {
                return redirect()->back()->with('error', 'Sản phẩm này trong đơn hàng này bạn đã đánh giá');
            }
        } else {
            return redirect()->back()->with('error', 'Không có sản phẩm mà bạn muốn đánh giá');
        }
    }
    public function CreateRate(Request $request)
    {
        if(isset($_SESSION['Rate'])){
            $rate = Rate::query()->where('order_id', $_SESSION['Rate']->order_id)
                                ->where('product_id', $_SESSION['Rate']->product_id)
                                ->where('product_variant_id', $_SESSION['Rate']['product_variant_id'])->first();
    
            if ($rate != null) {
                    return redirect()->route('Client.orders.show',['order_code'=>$_SESSION['Rate']->order_code, 'order_id'=>$_SESSION['Rate']->order_id])->with('message', 'Sản phẩm này trong đơn hàng đã được đánh giá')->with('status',"false");
            } else {
            if (!empty($request->content)) {
                if (!$this->ValidateText($request->content)) {
                    return redirect()->back()->with('content', 'Nội dung đánh giá không hợp lệ');
                }
            }
            if (isset($request->number_stars)) {
                $request->validate(
                    [
                        'number_stars' => 'integer|max:5'
                    ],
                    [
                        'number_stars.integer' => "số sao đánh giá không hợp lệ",
                        'number_stars.max' => "số sao đánh giá không hợp lệ"
                    ]
                );
            }
            $data = [
                'order_id' => $_SESSION['Rate']->order_id,
                'product_id' => $_SESSION['Rate']->product_id,
                'product_variant_id' => $_SESSION['Rate']['product_variant_id'],
                // 'user_id' => 1,
                'user_id' =>Auth::user()->user_id,
                'star' => $request->number_stars,
                'content' => $request->content
            ];
            $rate = Rate::create($data);
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file[0] != null) {
                    foreach ($file as $item) {
                        $path_image = $item->store('rates');
                        $data = [
                            'rate_id' => $rate->rate_id,
                            'image_name' => $path_image
                        ];
                        RateImage::create($data);
                    }
                }
            }
            $order = Order::where('order_id', $rate->order_id)->get();
            unset($_SESSION['Rate']);
            return redirect()->route('Client.orders.show', [$order[0]->order_code, $order[0]->order_id])->with('message', 'Cảm ơn bạn đã đánh giá sản phẩm!')->with('status',"true");
        }
    }
    else{
        $order = Order::where('order_code', $_SESSION['order_code'])->first();
        return redirect()->route('Client.orders.show', [$order->order_code, $order->order_id])->with('message', 'Sản phẩm này trong đơn hàng đã được đánh giá')->with('status',"false");
    }
    }
    function ValidateText($string)
    {
        // Tạo biểu thức chính quy từ danh sách các ký tự đặc biệt
        $arrayK = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', "'", '<', ',', '.', '?');
        $content = str_split($string);
        $check = true;
        foreach ($content as $item) {
            foreach ($arrayK as $value) {
                if ($item === $value) {
                    $check = false;
                }
            }
        }
        // Kiểm tra xem chuỗi có khớp với biểu thức chính quy hay không
        return $check;
    }
    
}
