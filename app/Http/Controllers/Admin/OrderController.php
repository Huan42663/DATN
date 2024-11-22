<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $data = Order::query()->get();
        return View('admin.orders.index', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $order_code)
    {

           
             $infoOrder =   Order::query()->where('order_code', '=', $order_code)->get();
                
             $detail   =   Order::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
                            ->join('product_variant', 'order_detail.product_variant_id', "=", 'product_variant.product_variant_id')
                            ->join('products', 'product_variant.product_id', "=", 'products.product_id')
                            ->join('sizes', 'product_variant.size_id', "=", 'sizes.size_id')
                            ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                            ->select(
                                'order_detail.price',
                                'order_detail.sale_price',
                                'order_detail.quantity',
                                'products.product_name',
                                'products.product_image',
                                'sizes.size_name',
                                'colors.color_name'
                            )
                            ->where('orders.order_code', '=', $order_code)
                            ->get();

        return View('admin.orders.show',compact('infoOrder','detail'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $order_id)
    {
        $request["status"] = "confirmed";
        $data =['status'=>$request["status"]];
        Order::query()->where('order_id', '=', $order_id)->update($data);
        return redirect()->back();
    }

}
