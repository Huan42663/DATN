<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Post;
use App\Models\Products;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $order     = count(Order::query()->get());
        $product   = count(Products::query()->get());
        $user      = count(User::query()->where('role', 'guest')->get());
        $post      = count(Post::query()->get());
        // Lấy số lượng sản phẩm theo danh mục
        $chartCategoryProduct = Category::query()
            ->leftJoin('category_product', 'categories.category_id', '=', 'category_product.category_id')
            ->leftJoin('products', 'category_product.product_id', '=', 'products.product_id')
            ->where('products.status', 1)
            ->selectRaw('categories.category_name as category_name , COUNT(products.product_id) as quantityProduct')
            ->groupBy('categories.category_name')
            ->get();
        $name = [];
        $value = [];
        foreach ($chartCategoryProduct as $key) {
            $name[] = $key['category_name'];
        }
        foreach ($chartCategoryProduct as $key) {
            $value[] = $key['quantityProduct'];
        }


        $json_array1 = json_encode($name);
        $json_array2 = json_encode($value);
        //Lấy Top 10 Sản phẩm được mua nhiều nhất
        $productHot = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->join('order_detail', 'products.product_id', '=', 'order_detail.product_id')
            ->join('orders', 'order_detail.order_id', '=', 'orders.order_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_name, products.product_image,product_slug,COUNT(products.product_id) as quantityProduct,Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_name', 'products.product_image', 'product_slug')
            ->having('quantityProduct', '>', 0)
            ->orderBy('quantityProduct', 'desc')
            ->limit(10)
            ->get();
        //Lấy Doanh thu các tháng trong năm
        $year = "";
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = Carbon::now()->year;
        }
        // dd($year);
        $totalMonthInYear = Order::query()
            ->selectRaw('YEAR(created_at) as year , MONTH(created_at) as month, SUM(total) as total')
            ->whereRaw("status = 'delivered' OR status = 'received'")
            ->whereYear('created_at', $year)
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderBy("month", "ASC")
            ->get();
        // dd($totalMonthInYear);
        $total = [];
        foreach($totalMonthInYear as $check){
            if($check->year == $year){
                array_push($total, $check);
            }
        }
        $YearTotal = [];
        $j = 0;
        for ($i = 1; $i < 13; $i++) {
            if (!empty($total)) {
                if ($i ==  $total[$j]->month &&  $total[$j]->year == $year) {
                        array_push($YearTotal,  $total[$j]->total);
                        $j++;
                } else {
                    array_push($YearTotal, 0);
                }
            }else {
                array_push($YearTotal, 0);
            }
        }
        $json_array = json_encode($YearTotal);
        // dd($json_array,$totalMonthInYear , $YearTotal);
        //Lấy Sản Phẩm Mới trong tháng
        $month = Carbon::now()->month;
        $productNew = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_name, products.product_image,product_slug,Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
            ->orderBy('products.product_id', 'desc')
            ->limit(10)
            ->whereNull('deleted_at')->get();
        $orderUnconfirm = Count(Order::query()->where('status', 'unconfirm')->get());
        $orderCancel = Count(Order::query()->where('status', 'canceled')->get());
        $orderReturn = Count(Order::query()->where('status', 'return')->get());
        $orderReceived = Count(Order::query()->where('status', 'received')->get());
        $orderConfirm = Count(Order::query()->where('status', 'confirm')->get());
        $orderShip = Count(Order::query()->where('status', 'shipping')->get());
        $orderDelivered = Count(Order::query()->where('status', 'delivered')->get());
        return view(
            'admin.home',
            compact(
                'product',
                'order',
                'year',
                'user',
                'post',
                'productHot',
                'productNew',
                'chartCategoryProduct',
                'json_array',
                'json_array1',
                'json_array2',
                'orderUnconfirm',
                'orderConfirm',
                'orderShip',
                'orderDelivered',
                'orderReturn',
                'orderReceived',
                'orderCancel'
            )
        );
    }
}
