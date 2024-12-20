<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request){
        $cart = "";
        if(isset(Auth::user()->user_id)){
            $cart = $this->showCart(Auth::user()->user_id);
        }
        // $cart = $this->showCart(1);
        // dd(Auth::check());
        return View('client.cart',compact('cart'));
    }
    public function store(Request $request){
        $cart_id = Cart::query()->where('user_id',Auth::user()->user_id)->firstOrFail();
        $product = ProductVariant::query()
                   ->where('product_variant.product_id',$request->product_id)
                   ->where('product_variant.size_id',$request->size_id)
                   ->where('product_variant.color_id',$request->color_id)
                   ->first();
        if(!isset($product)){
            return response()->json(["data"=>"Vui lòng chọn đầy đủ kích thước và màu"],Response::HTTP_NOT_FOUND);  
        }
        if(isset($product) && $product->quantity < $request['quantity']){
            return response()->json(["data"=>"Số lượng sản phẩm bạn vừa thêm vào giỏ hàng đã quá số lượng chúng tôi có là ". $product->quantity],Response::HTTP_BAD_REQUEST);  
        }
        $data = 
        [
           "cart_id"            =>$cart_id->cart_id,
           "product_variant_id" =>$product->product_variant_id,
           "quantity"           =>$request->quantity
        ];
        $cart = CartDetail::query()
                            ->join('product_variant','cart_detail.product_variant_id','=','product_variant.product_variant_id')
                            ->where('cart_detail.cart_id',$cart_id->cart_id)
                            ->where('cart_detail.product_variant_id',$product->product_variant_id)
                            ->select('cart_detail.product_variant_id','cart_detail.quantity as cartQuantity')
                            ->first();
        if(!isset($cart)){
            CartDetail::create($data);
        }
        else{
            $data['quantity'] = $cart->cartQuantity + $request['quantity'];
            if($data['quantity'] > $product->quantity){
                return response()->json(["data"=>"Số lượng sản phẩm bạn vừa thêm vào giỏ hàng và số lượng sản phẩm bạn có trong giỏ hàng đã quá số lượng chúng tôi có là :".$product->quantity],Response::HTTP_BAD_REQUEST);  
             }
            else{
                CartDetail::query()->where('cart_detail.cart_id',$cart_id->cart_id)
                            ->where('cart_detail.product_variant_id',$product->product_variant_id)
                            ->update($data);
            }
        }
        $cart = $this->showCart(Auth::user()->user_id);
        $countCart = Count($cart['Cart']);
        return response()->json(["data"=>"Thêm sản phẩm vào giỏ hàng thành công","countCart"=>$countCart],Response::HTTP_CREATED);  

    }
    public function UpdateCartDetail(Request $request)
    {
        $check = CartDetail::query()->where('cart_detail_id',$request->cart_detail_id)->get();
        if(!$check){
            return response()->json(['data' => 'không tìm thấy sản phẩm'],404);
        }else{
            $check1 = ProductVariant::where('product_variant_id',$check[0]->product_variant_id)->get();
            if(!$check1){
                return response()->json(['data'=>"Không tìm thấy sản phẩm của bạn",'status' => false],404);
            }else{
                $data =[
                    'cart_detail_id' =>$request->cart_detail_id,
                    'quantity'       =>$request->quantity
                ];
                if($check1[0]->quantity >= $request->quantity){
                    CartDetail::query()->where('cart_detail_id',$request->cart_detail_id)->update($data);
                    return response()->json(['success' => true],200);
                }else{
                    return response()->json(['status' => false,'check'=>$check1[0]->quantity],Response::HTTP_BAD_REQUEST);
                }
                
            }
            
        }
    }
    public function DestroyCart(Request $request)
    {
        foreach($request->cart_variant_id as $item){
            CartDetail::find($item)->delete();
        }
        // CartDetail::where('cart_detail_id',$id)->delete();
        // $cart =$this->showCart(1);
        return redirect()->route('Client.cart.list');
                                     
    }
    function showCart( $id) {
        $cart = Cart::query()
        ->leftJoin("cart_detail","carts.cart_id","=","cart_detail.cart_id")
        ->leftJoin("product_variant","cart_detail.product_variant_id","=","product_variant.product_variant_id")
        ->leftJoin("products","product_variant.product_id","=","products.product_id")
        ->leftJoin("sizes","product_variant.size_id","=","sizes.size_id")
        ->leftJoin("colors","product_variant.color_id","=","colors.color_id")
        // ->leftJoin("variant_image_color","product_variant.product_variant_id","=","variant_image_color.product_variant_id")
        // ->leftJoin("image_color","variant_image_color.image_color_id","=","image_color.image_color_id")
        ->selectRaw(
        'cart_detail.cart_detail_id,products.product_id,products.product_name,products.product_slug,products.product_image,sizes.size_id as size_id, colors.color_id as color_id,
                     sizes.size_name as size ,colors.color_name as color,cart_detail.quantity,product_variant.price,product_variant.quantity as Instock,
                     CASE WHEN product_variant.sale_price > 0 THEN product_variant.sale_price
                     END AS sale_price,
                     CASE 
                     WHEN product_variant.sale_price > 0 THEN product_variant.sale_price * cart_detail.quantity
                     ELSE product_variant.price * cart_detail.quantity
                     END AS total '
        )
        ->where('user_id',$id)
        ->get();

        $sumPrice = 0;
        $sumSalePrice=0;
        foreach( $cart as $item ){
            $sumPrice += ($item->price * $item->quantity);
            $sumSalePrice += $item->total;
        }
        if($sumPrice>0){
            $cartReturn = ["Cart"=>$cart,"sumTotal"=>$sumPrice,"sumTotalSale"=>$sumSalePrice];
            return $cartReturn;
        }else{
            return "Không có sản phẩm nào trong giỏ hàng";
        }
       
    }
}
