<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
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
        return response()->json(
            [
                'message' => "Danh sách order",
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        try {
            $data = [
                Order::query()->where('order_id', '=', $id)->get(),
                Order::join('order_detail', 'orders.order_id', '=', 'order_detail.order_id')
                    ->join('product_variant', 'order_detail.product_variant_id', "=", 'product_variant.product_variant_id')
                    ->join('products', 'product_variant.product_id', "=", 'products.product_id')
                    ->join('sizes', 'product_variant.size_id', "=", 'sizes.size_id')
                    ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                    ->select(
                        'order_detail.price',
                        'order_detail.sale-price',
                        'order_detail.quantity',
                        'products.product_name',
                        'products.product_image',
                        'sizes.size_name',
                        'colors.color_name'
                    )
                    ->where('orders.order_id', '=', $id)
                    ->get()

            ];
            if (count($data[0]) > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết đơn hàng",
                        'data' => $data,
                    ]
                );
            } else {
                return response()->json(
                    ['message' => "Không tìm thấy đơn hàng"],
                    Response::HTTP_NOT_FOUND
                );
            }
        } catch (\Throwable $th) {
            FacadesLog::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['message' => "Không tìm thấy đơn hàng"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
