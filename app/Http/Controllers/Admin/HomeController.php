<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
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
    public function test() {
        return view('client.home');
    }
    public function index(Request $request)
    {
        $category  = count(Category::query()->get());
        $product   = count(Products::query()->get());
        $user      = count(User::query()->where('role', 'guest')->get());


        // Lấy số lượng sản phẩm theo danh mục
        $chartCategoryProduct = Category::query()
            ->leftJoin('category_product', 'categories.category_id', '=', 'category_product.category_id')
            ->leftJoin('products', 'category_product.product_id', '=', 'products.product_id')
            ->where('products.status', 1)
            ->selectRaw('categories.category_name as category_name , COUNT(products.product_id) as quantityProduct')
            ->groupBy('categories.category_name')
            ->get();

        //Lấy Top 10 Sản phẩm được mua nhiều nhất
        $productHot = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->join('order_detail', 'product_variant.product_variant_id', '=', 'order_detail.product_variant_id')
            ->join('orders', 'order_detail.order_id', '=', 'orders.order_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_name, products.product_image,product_slug,COUNT(product_variant.product_variant_id) as quantityProduct,MIN(product_variant.price) as minPrice , Max(product_variant.sale_price) as maxPrice')
            ->groupBy('products.product_name', 'products.product_image', 'product_slug')
            ->having('quantityProduct', '>', 0)
            ->limit(10)
            ->get();


        //Lấy Doanh thu các tháng trong năm
        $year = "";
        if (isset($request['year'])) {
            $year = $request['year'];
        } else {
            $year = Carbon::now()->year;
        }
        $totalMonthInYear = Order::query()
            ->selectRaw('YEAR(created_at) as year , MONTH(created_at) as month, SUM(total) as total')
            ->whereRaw("YEAR(created_at) = $year")
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->get();

        //Lấy Sản Phẩm Mới trong tháng
        $month = Carbon::now()->month;
        $productNewMonth = Products::query()->whereRaw("MONTH(created_at)= $month")->get();

        $orderUnconfirm = Count(Order::query()->where('status', 'unconfirm')->get());
        $orderConfirm = Count(Order::query()->where('status', 'confirm')->get());
        $orderShip = Count(Order::query()->where('status', 'shipping')->get());
        $orderDelivered = Count(Order::query()->where('status', 'delivered')->get());

        return response()->json([
            'CountProduct' => $product,
            'CountCategory' => $category,
            'CountUser' => $user,
            'productHot' => $productHot,
            'productNewMonth' => $productNewMonth,
            'chartCategoryProduct' => $chartCategoryProduct,
            'totalMonthInYear' => $totalMonthInYear,
            'CountOrderUnconfirm' => $orderUnconfirm,
            'CountOrderConfirm' => $orderConfirm,
            'CountOrderShip' => $orderShip,
            'CountOrderDelivered' => $orderDelivered,

        ], Response::HTTP_OK);
    }
}
