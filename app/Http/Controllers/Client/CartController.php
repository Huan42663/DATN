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
    public function index(){
        $cart = $this->showCart(Auth::user()->id);

        return response()->json($cart,Response::HTTP_OK);
    }
    public function store(Request $request){
        $cart_id = Cart::query()->where('user_id',Auth::user()->id)->get();
        $product = ProductVariant::query()
                   ->leftJoin('sizes','product_variant.size_id','=','sizes.size_id')
                   ->leftJoin('colors','product_variant.color_id','=','colors.color_id')
                   ->where('product_variant.product_id',$request['product_id'])
                   ->where('product_variant.size_id',$request['size_id'])
                   ->where('product_variant.color_id',$request['color_id'])
                   ->get();
        if(empty($product)){
            return response()->json("Sản phẩm bạn vừa thêm không có vui lòng kiểm tra lại",Response::HTTP_NOT_FOUND);  
        }
        if(!empty($product) && $product[0]->quantity < $request['quantity']){
            return response()->json("Số lượng sản phẩm bạn vừa thêm vào giỏ hàng đã quá số lượng chúng tôi có!",Response::HTTP_BAD_REQUEST);  
        }
        $data = 
        [
           "cart_id"            =>$cart_id[0]->cart_id,
           "product_variant_id" =>$product[0]->product_variant_id,
           "quantity"           =>$request['quantity']
        ];
        $cart = CartDetail::query()
                            ->join('product_variant','cart_detail.product_variant_id','=','product_variant.product_variant_id')
                            ->where('cart_detail.cart_id',$cart_id[0]->cart_id)
                            ->where('cart_detail.product_variant_id',$product[0]->product_variant_id)
                            ->select('cart_detail.product_variant_id','cart_detail.quantity as cartQuantity')
                            ->get();
        if(count($cart) <= 0){
            CartDetail::create($data);
        }
        else{
            $data['quantity'] = $cart[0]->cartQuantity + $request['quantity'];
            if($data['quantity'] > $product[0]->quantity){
                return response()->json("Số lượng sản phẩm bạn vừa thêm vào giỏ hàng đã quá số lượng chúng tôi có!",Response::HTTP_BAD_REQUEST);  
             }
            else{
                CartDetail::query()->where('cart_detail.cart_id',$cart_id[0]->cart_id)
                            ->where('cart_detail.product_variant_id',$product[0]->product_variant_id)
                            ->update($data);
            }
        }
        return response()->json("Thêm sản phẩm vào giỏ hàng thành công",Response::HTTP_CREATED);  

    }
    public function UpdateCartDetail(Request $request, $id)
    {
        $cartUpdate = Cart::query()->join('cart_detail','carts.cart_id','=','cart_detail.cart_id')
                                   ->where('carts.user_id',Auth::user()->id)
                                   ->where('product_variant_id',$id)
                                   ->get();
       
        if(isset($request['add'])){
            $quantityUpdate = $cartUpdate[0]->quantity + 1;
        }
        if(isset($request['remove'])){
            $quantityUpdate = $cartUpdate[0]->quantity - 1;
        }

        if($quantityUpdate == 0){
            $cartUpdate1 = CartDetail::query()->where('cart_id',1)->where('product_variant_id',$id)->delete();
        }if($quantityUpdate > 0){
            $cartUpdate1 = CartDetail::query()->where('cart_id',1)->where('product_variant_id',$id)->update(array('quantity'=>$quantityUpdate));
        }
        
        $cart =$this->showCart(1);
        return response()->json( $cart,Response::HTTP_OK);
                                     
    }
    public function DestroyCart($id)
    {
        CartDetail::where('cart_detail_id',$id)->delete();
        $cart =$this->showCart(1);
        return response()->json( $cart,Response::HTTP_OK);
                                     
    }
    function showCart( $id) {
        $cart = Cart::query()
        ->leftJoin("cart_detail","carts.cart_id","=","cart_detail.cart_id")
        ->leftJoin("product_variant","cart_detail.product_variant_id","=","product_variant.product_variant_id")
        ->leftJoin("products","product_variant.product_id","=","products.product_id")
        ->leftJoin("sizes","product_variant.size_id","=","sizes.size_id")
        ->leftJoin("colors","product_variant.color_id","=","colors.color_id")
        ->leftJoin("variant_image_color","product_variant.product_variant_id","=","variant_image_color.product_variant_id")
        ->leftJoin("image_color","variant_image_color.image_color_id","=","image_color.image_color_id")
        ->selectRaw(
        'cart_detail.cart_detail_id,products.product_name,products.product_slug,image_color.image_color_name AS image_color,products.product_image,
                     sizes.size_name as size ,colors.color_name as color,cart_detail.quantity,product_variant.price,
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
