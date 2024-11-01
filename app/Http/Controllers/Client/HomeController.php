<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\CategoryPost;
use App\Models\Post;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    public function index()
    {
        
        $Category_post_header    = CategoryPost::query()->where('showHeader',true)->get();

        // $Category_post_header1    = CategoryPost::query()->with('posts')->where('showFooter',true)->get();
        $Category_post_footer    =     CategoryPost::with('categoryPost1')->where('showFooter',true)->get();;
       
        $Product_hot             =  Products::query()
                                    ->join('product_variant','products.product_id','=','product_variant.product_id')
                                    ->join('order_detail','product_variant.product_variant_id','=','order_detail.product_variant_id')
                                    ->join('orders','order_detail.order_id','=','orders.order_id')
                                    ->where('products.status',1)
                                    ->selectRaw('products.product_name, products.product_image,product_slug,COUNT(product_variant.product_variant_id) as quantityProduct,MIN(product_variant.price) as minPrice , Max(product_variant.sale_price) as maxPrice')
                                    ->groupBy('products.product_name','products.product_image','product_slug')
                                    ->limit(10)
                                    ->get();

        $productNew             = Products::query()->where("status",1)->orderByDesc('product_id')->get();
        $Banner                 = Banner::query()->get();

        function build_tree(&$items, $parentId = null) {
            $treeItems = [];
            foreach ($items as $idx => $item) {
                if((empty($parentId) && empty($item['category_parent_id'])) || (!empty($item['category_parent_id']) && !empty($parentId) && $item['category_parent_id'] == $parentId)) {
                    $items[$idx]['children'] = build_tree($items, $items[$idx]['category_id']);
                    $treeItems []= $items[$idx];
                }
            }
        
            return $treeItems;
        }

        // }
        $arr= Category::query()->get();
        
        $arr_tree = build_tree($arr);
    
        return response() -> json(
            [
                'CategoryProduct'   =>$arr_tree,
                'CategoryPostHeader'=>$Category_post_header,
                'CategoryPostFooter'=>$Category_post_footer,
                'Banner'            =>$Banner,
                'ProductNew'        =>$productNew,
                'ProductHot'        =>$Product_hot,
            ],Response::HTTP_OK);
    }
    
}
