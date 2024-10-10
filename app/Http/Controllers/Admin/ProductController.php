<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $data = Products::query()->get();
        return response()->json(
            [
                'message' => 'Danh sách sản phẩm',
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }


    public function store(Request $request) {}

    public function show($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return response()->json(
                [
                    'message' => "Sản phẩm không tồn tại"
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        return response()->json(
            [
                'message' => "Chi tiết sản phẩm",
                'data' => $product
            ],
            Response::HTTP_OK
        );
    }

    public function update(Request $request, $id) {}

    public function destroy($id) {}

    public function getRates($productId)
    {
        $product = Products::find($productId);
        if (!$product) {
            return response()->json(
                [
                    'message' => "Sản phẩm không tồn tại"
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        // Lấy danh sách đánh giá của sản phẩm



        $rates = DB::table('rates')
            ->join('rate_image', 'rates.rate_id', '=', 'rate_image.rate_id')
            ->join('users', 'rates.user_id', '=', 'users.user_id')
            ->join('product_variant', 'rates.product_variant_id', '=', 'product_variant.product_variant_id')
            ->join('products', 'product_variant.product_id', '=', 'products.product_id')
            ->where('products.product_id', $productId)
            ->select(
                'users.fullName',
                'users.email',
                'products.product_name',
                'rate_image.image_name',
                'rates.star',
                'rates.content',
                'rates.created_at',
            )->first();



        if (empty($rates)) {
            return response()->json(
                [
                    'message' => "Sản phẩm chưa có lượt đánh giá nào",
                    'data' => $rates
                ],

            );
        } else {
            return response()->json(
                [
                    'message' => "Danh sách đánh giá",
                    'data' => $rates
                ],
                Response::HTTP_OK
            );
        }
    }
}
