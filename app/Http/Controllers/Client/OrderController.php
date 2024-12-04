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
use App\Models\Rate;
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
           if($key->date_end == $date || $key->date_end < $date){
               Voucher::query()->where('voucher_id',$key->voucher_id)->update($data);
           }
        }
    }
    public function index()
    {
        // if (!auth()->check()) {
        //     return redirect()->route('Client.account.showLoginForm')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        // }
        $userId = 1;
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
        // dd($order->orderDetail);
        return view('client.orders.show', compact('order'));
    }
    public function orderCart(Request $request){
        $data = explode(', ', $request->product[0]);
        $voucher = Voucher::where('date_end','>=',Carbon::now())->where('date_start','<=',Carbon::now())->where('quantity','>',0)->get();
        $cart = new CartController();
        // $data1 = $cart->showCart(Auth()->user()->user_id);
        $data1 = $cart->showCart(1);
        foreach ($data as  $value) {
            $product = CartDetail::where('cart_detail_id',$value)->get();
            if(!count($product)>0){
                return redirect()->back()->with('error',"Sản Phẩm Bạn chọn không tồn tại trong giỏ hàng vui lòng kiểm tra lại");
            }
        }
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
            $_SESSION['dataInfo'] = $request->except('_token','voucher_code','voucher');
            $request->validate([
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
        if(!$this->ValidateText($request->fullname)){
            return redirect()->back()->with('fullname','Họ tên không đúng định dạng');
        }
        if(!$this->ValidateText($request->street)){
            return redirect()->back()->with('street','Đường không đúng định dạng');
        }
        if(!$this->ValidateText($request->address)){
            return redirect()->back()->with('address','Địa Chỉ không đúng định dạng');
        }
        if(!empty($request->note) && !$this->ValidateText($request->note)){
            return redirect()->back()->with('note','Note không đúng định dạng');
        }
        $pattern = '/^(0|\+84|\+841|\+849|\+8498)([2-9]\d{8})$/';
        if(!preg_match($pattern, $request->phone)){
            return redirect()->back()->with('phone','Số điện thoại không đúng định dạng');
        }
        dd($request->all());

        $data1 = [
            'fullname'=>$request->fullname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'total'=>$request->total,
            'total_discount'=>$request->total_discount,
            'method_payment'=>$request->method_payment,
            'user_id'=>1,
            // 'user_id'=>Auth()->user()->user_id,
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
        $data = $cart->showCart(1);
        // $data = $cart->showCart(Auth()->user()->user_id);
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
                    $product_variant = ProductVariant::query()->where('product_id',$item->product_id)->where('size_id',$item->size_id)->where('color_id',$item->color_id)->get();
                    $quantity = $product_variant[0]->quantity - $item->quantity;
                    $dataUpdate = ['quantity'=>$quantity];
                    ProductVariant::query()->where('product_id',$item->product_id)->where('size_id',$item->size_id)->where('color_id',$item->color_id)->update($dataUpdate);
                }
            }
            if(isset($_SESSION['voucher'])){
                $voucherUse = Voucher::query()->where('voucher_id',$_SESSION['voucher'][0]->voucher_id)->get();
                $quantityVoucher = $voucherUse[0]->quantity - 1;
                $dataVoucherUpdate = ['quantity'=>$quantityVoucher];
                Voucher::query()->where('voucher_id',$_SESSION['voucher'][0]->voucher_id)->update($dataVoucherUpdate);
                unset($_SESSION['voucher']);
            }
        }
           return redirect()->route('Client.Home')->with('success','Cảm Ơn Bạn Đã Tin Tưởng Đặt Hàng Của Chúng Tôi !');
        }
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
    public function rates(string $product_id,string $order_code){
            $product = OrderDetail::query()
                       ->join('orders','order_detail.order_id','=','orders.order_id')
                       ->join('products','order_detail.product_id','=','products.product_id')
                       ->leftJoin('sizes','order_detail.size','=','sizes.size_name')
                       ->leftJoin('colors','order_detail.color','=','colors.color_name')
                       ->where('order_detail.product_id',$product_id)
                       ->where('orders.order_code',$order_code)
                       ->where('orders.user_id',1)  
                    //    ->where('orders.user_id',Auth::user()->user_id)
                       ->selectRaw('products.*,order_detail.*,orders.order_id')
                       ->get();
            
            $productCheck = ProductVariant::leftJoin('sizes','product_variant.size_id','=','sizes.size_id')
                            ->leftJoin('colors','product_variant.color_id','=','colors.color_id')
                            ->where('product_variant.product_id',$product[0]->product_id)
                            ->where('sizes.size_name',$product[0]->size)
                            ->where('colors.color_name',$product[0]->color)
                            ->get();

            $rate = Rate::query()->where('order_id',$product[0]->order_id)->where('product_id',$product[0]->product_id)->where('product_variant_id',$productCheck[0]->product_variant_id)->get();

            if(count($product)>0){
                if(count($rate)==0){
                    $_SESSION['Rate'] = $product;
                    $_SESSION['Rate']['product_variant_id'] = $productCheck[0]->product_variant_id;
                    return View('client.rate',compact('product'));
                }else{
                    return redirect()->back()->with( 'error','Sản phẩm này trong đơn hàng này bạn đã đánh giá');
                }
            }
            else{
                return redirect()->back()->with('error','Không có sản phẩm mà bạn muốn đánh giá');
            }
    }
    public function CreateRate(Request $request){

        if(!empty($request->content)){
            if(!$this->ValidateText($request->content))
                {
                    return redirect()->back()->with('content','Nội dung đánh giá không hợp lệ');
                }
        }
        if(isset($request->number_stars)){
            $request->validate(
                [
                    'number_stars' => 'integer|max:5'
                ],
                [
                    'number_stars.integer' =>"số sao đánh giá không hợp lệ",
                    'number_stars.max' =>"số sao đánh giá không hợp lệ"
                ]
            );
        }
        $data = [
            'order_id' => $_SESSION['Rate'][0]->order_id,
            'product_id' =>$_SESSION['Rate'][0]->product_id,
            'product_variant_id'=>$_SESSION['Rate']['product_variant_id'],
            'user_id' =>1,
            // 'user_id' =>Auth::user()->user_id,
            'star' =>$request->number_stars,
            'content' =>$request->content
        ];
        $rate = Rate::create($data);
        if($request->hasFile('image')){
            $file = $request->file('image');
            if($file[0] !=null){
                foreach($file as $item){
                    $path_image = $item->store('rates');
                    $data = [
                        'rate_id'=>$rate->rate_id,
                        'image_name' =>$path_image
                    ];
                    RateImage::create($data);
                }
            }
        }
        $order = Order::where('order_id',$rate->order_id)->get();
        unset($_SESSION['Rate']);
        return redirect()->route('Client.orders.show', [$order[0]->order_code, $order[0]->order_id])->with('massage', 'Cảm ơn bạn đã đánh giá sản phẩm!');
    }
    function ValidateText($string) {
        // Tạo biểu thức chính quy từ danh sách các ký tự đặc biệt
        $arrayK = array('!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '+', '=', '{', '}', '[', ']', '|', '\\', ':', ';', '"', "'", '<', ',', '.', '?');
        $content = str_split($string);
        $check = true;
        foreach($content as $item){
            foreach($arrayK as $value){
                if($item === $value){
                    $check = false;
                }
            }
        }
        // Kiểm tra xem chuỗi có khớp với biểu thức chính quy hay không
        return $check;
    }
    
    
}
