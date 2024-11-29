<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Event;
use App\Models\Post;
use App\Models\Products;
use App\Models\Voucher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
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
        $Category_post_header    =     CategoryPost::query()->where('showHeader',true)->get();

        $Category_post_footer    =     CategoryPost::with('categoryPost1')->where('showFooter',true)->get();;

        $Product_hot             =  Products::query()
                                    ->join('product_variant','products.product_id','=','product_variant.product_id')
                                    ->join('order_detail','products.product_id','=','order_detail.product_id')
                                    ->join('orders','order_detail.order_id','=','orders.order_id')
                                    ->where('products.status',1)
                                    ->selectRaw('products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                                    ->groupBy('products.product_name','products.product_image','product_slug')
                                    ->limit(8)
                                    ->get();

        $productNew              = Products::query()
                                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                                ->where('products.status',1)
                                ->selectRaw('products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                                ->groupBy('products.product_name', 'products.product_image', 'product_slug')
                                ->limit(8)
                                ->get();
        $Banner                 = Banner::query()->get();

        $events                  = Event::query()->
                                join('banners','events.event_id','=','banners.event_id')
                                 ->where('banners.event_id',"!=",null)
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
    
        return View('client.home', compact('Category_post_header','Category_post_footer','Banner','events','productNew','Product_hot'));
    }

}
