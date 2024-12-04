<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bill;
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
           
        // dd($order_code);
             $infoOrder =   Order::query()->where('order_code', $order_code)->get();
             
             $bill      =  Bill::query()->where('order_id', '=', $infoOrder[0]->order_id)->get();
                
             $detail   =   Order::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
                            ->join('products', 'order_detail.product_id', "=", 'products.product_id')
                            // ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                            // ->join('sizes', 'product_variant.size_id', "=", 'sizes.size_id')
                            // ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                            ->select(
                                'order_detail.price',
                                'order_detail.sale_price',
                                'order_detail.quantity',
                                'products.product_name',
                                'products.product_image',
                                'order_detail.size',
                                'order_detail.color',
                               
                            )
                            ->where('orders.order_code', '=', $order_code)
                            ->get();
                          
                            // dd($detail);
        return View('admin.orders.show',compact('infoOrder','detail','bill'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $order_id){
        $value =  Order::query()->where('order_id', '=', $order_id)->get();
        // dd($value);
        if ($value[0]->status == "unconfirm") $request["status"] = "confirmed";                     
        elseif($value[0]->status == "confirmed") $request["status"] = "shipping";           
        elseif($value[0]->status == "shipping") $request["status"] = "delivered";                
        $data =['status'=>$request["status"]];
        Order::query()->where('order_id', '=', $order_id)->update($data);
        return redirect()->back();
    }

}
