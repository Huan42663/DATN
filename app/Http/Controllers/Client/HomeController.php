<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bill;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Event;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Post;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
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
    }
    public function index()
    {
        if(isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] != 00){
            return redirect()->route('Client.orders.orderCart');
        }
        else if(isset($_GET['vnp_ResponseCode']) && $_GET['vnp_ResponseCode'] == 00){
            // $_SESSION['inforOrder']['total_discount'] = 0;
            $order = Order::create($_SESSION['infoOrder']);
            foreach ( $_SESSION['listCart'] as $item) {
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
            $dataBill = 
            [ 			
                "bank_code" => $_GET['vnp_BankCode'],	
                "order_id" => $order->order_id,
                "bank_tranno" => $_GET['vnp_BankTranNo'],	
                "amount" => ($_GET['vnp_Amount']/100),
                "card_type" => $_GET['vnp_CardType'],	
                "vnpay_transactionno" => $_GET['vnp_TransactionNo'],	
                "created_at" => $_GET['vnp_PayDate'],
            ];
            Bill::create($dataBill);
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
            unset( $_SESSION['listCart']);
            unset($_SESSION['infoOrder']);
            return redirect()->route('Client.orders.thank');
        }
        $Category_post_header    =     CategoryPost::query()->where('showHeader', true)->get();

        $Category_post_footer    =     CategoryPost::with('categoryPost1')->where('showFooter', true)->get();

        $Product_hot             =  Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->join('order_detail', 'products.product_id', '=', 'order_detail.product_id')
            ->join('orders', 'order_detail.order_id', '=', 'orders.order_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_name, products.product_image,product_slug, COUNT(products.product_id) as quantityProduct, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_name', 'products.product_image', 'product_slug')
            ->orderBy('quantityProduct', 'desc')
            ->limit(8)
            ->get();
        $productNew              = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
            ->limit(8)
            ->orderBy('products.product_id', 'desc')
            ->get();
        $Banner                 = Banner::query()->get();

        $events                  = Event::query()->join('banners', 'events.event_id', '=', 'banners.event_id')
            ->where('banners.event_id', "!=", null)
            ->selectRaw('events.*, MAX(banners.image_name) as banner')
            ->groupBy('events.event_id')->limit(2)->get();
        // function build_tree(&$items, $parentId = null) {
        //     $treeItems = [];
        //     foreach ($items as $idx => $item) {
        //         if((empty($parentId) && empty($item['category_parent_id'])) || (!empty($item['category_parent_id']) && !empty($parentId) && $item['category_parent_id'] == $parentId)) {
        //             $items[$idx]['children'] = build_tree($items, $items[$idx]['category_id']);
        //             $treeItems []= $items[$idx];
        //         }
        //     }

        //     return $treeItems;
        // }

        // }
        // $arr= Category::query()->get();

        // $arr_tree = build_tree($arr);

        // dd($arr_tree);
        // dd($Banner);
        return View('client.home', compact('Category_post_header', 'Category_post_footer', 'Banner', 'events', 'productNew', 'Product_hot'));
    }
}
