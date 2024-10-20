<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Rate;
use Carbon\Carbon;
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


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|string|max:255|unique:products',
            'description' => 'required|string|max:1000',
            'product_image' => 'required|string|max:255',
            'status' => 'required|integer', // Trường status
            'event_id' => 'required|integer',
            'size_id' => 'required|integer',
            'color_id' => 'required|integer',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'weight' => 'nullable|numeric',
        ]);


        try {
            // Tạo sản phẩm mới
            $productId = DB::table('products')->insertGetId([
                'product_name' => $validatedData['product_name'],
                'product_slug' => $validatedData['product_slug'],
                'description' => $validatedData['description'],
                'product_image' => $validatedData['product_image'],
                'status' => $validatedData['status'], // Thêm status vào đây
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Thêm vào bảng sản phẩm biến thể
            DB::table('product_variant')->insert([
                'size_id' => $validatedData['size_id'],
                'color_id' => $validatedData['color_id'],
                'product_id' => $productId,
                'price' => $validatedData['price'],
                'sale_price' => $validatedData['sale_price'],
                'quantity' => $validatedData['quantity'],
                'weight' => $validatedData['weight'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Thêm vào bảng sản phẩm sự kiện
            DB::table('product_event')->insert([
                'product_id' => $productId,
                'event_id' => $validatedData['event_id'],
                'status' => $validatedData['status'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);


            return response()->json(
                [
                    'message' => "Sản phẩm đã được tạo thành công",
                    'product_id' => $productId,
                ],
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {

            return response()->json(
                [
                    'message' => "Có lỗi xảy ra khi tạo sản phẩm",
                    'error' => $e->getMessage(), // Trả về thông báo lỗi chi tiết
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }



    public function show($id)
    {
        $product = DB::table('products')
            ->leftJoin('product_event', 'product_event.product_id', '=', 'products.product_id')
            ->leftJoin('events', 'events.event_id', '=', 'product_event.event_id')
            ->leftJoin('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->leftJoin('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
            ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
            ->leftJoin('rates', 'rates.product_variant_id', '=', 'product_variant.product_variant_id')
            ->leftJoin('rate_image', 'rate_image.rate_id', '=', 'rates.rate_id')
            ->select(
                'products.product_id',
                'products.product_name',
                'products.product_slug',
                'products.description',
                'products.product_image',
                'products.status',
                'products.created_at as product_created_at',
                'products.updated_at as product_updated_at',

                'product_variant.product_variant_id as product_variant',
                'product_variant.size_id',
                'product_variant.color_id',
                'product_variant.price',
                'product_variant.sale_price',
                'product_variant.quantity',
                'product_variant.weight',
                'product_variant.created_at as product_variant_created_at',
                'product_variant.updated_at as product_variant_updated_at',

                'sizes.size_name',
                'colors.color_name',
                'product_event.created_at as event_created_at',
                'events.event_id',
                'events.event_name',
                'events.date_start',
                'events.date_end',
                'events.type_event',
                'events.discount',
                'events.slug',
                'events.status',

                'rates.rate_id',
                'rates.order_id',
                'rates.user_id',
                'rates.star',
                'rates.content',
                'rates.created_at',
                'rates.rate_id',
                'rates.updated_at',

                'rate_image.*'
            )
            ->where('products.product_id', $id)
            ->first();


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

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'product_slug' => 'required|string|max:255|unique:products,product_slug,' . $id . ',product_id',
            'description' => 'required|string|max:1000',
            'product_image' => 'required|string|max:255',
            'status' => 'required|integer',
            'event_id' => 'required|integer',
            'size_id' => 'required|integer',
            'color_id' => 'required|integer',
            'price' => 'required|numeric',
            'sale_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'weight' => 'nullable|numeric',
        ]);

        try {
            // Cập nhật thông tin sản phẩm
            DB::table('products')->where('product_id', $id)->update([
                'product_name' => $validatedData['product_name'],
                'product_slug' => $validatedData['product_slug'],
                'description' => $validatedData['description'],
                'product_image' => $validatedData['product_image'],
                'status' => $validatedData['status'],
                'updated_at' => now(),
            ]);

            // Cập nhật thông tin sản phẩm biến thể
            DB::table('product_variant')->where('product_id', $id)->update([
                'size_id' => $validatedData['size_id'],
                'color_id' => $validatedData['color_id'],
                'price' => $validatedData['price'],
                'sale_price' => $validatedData['sale_price'],
                'quantity' => $validatedData['quantity'],
                'weight' => $validatedData['weight'],
                'updated_at' => now(),
            ]);

            // Cập nhật thông tin sản phẩm sự kiện
            DB::table('product_event')->where('product_id', $id)->update([
                'event_id' => $validatedData['event_id'],
                'status' => $validatedData['status'],
                'updated_at' => now(),
            ]);

            return response()->json(
                [
                    'message' => "Sản phẩm đã được cập nhật thành công",
                    'product_id' => $id,
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => "Có lỗi xảy ra khi cập nhật sản phẩm",
                    'error' => $e->getMessage(), // Trả về thông báo lỗi chi tiết
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function destroy($id)
    {
        try {
            $product = DB::table('products')->where('product_id', $id)->first();

            if (!$product) {
                return response()->json(
                    [
                        'message' => "Sản phẩm không tồn tại"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            // Xóa các bản ghi liên quan trước
            DB::table('product_event')->where('product_id', $id)->delete();
            DB::table('product_variant')->where('product_id', $id)->delete();

            // Xóa sản phẩm
            DB::table('products')->where('product_id', $id)->delete();
            return response()->json(
                [
                    'message' => "Sản phẩm đã được xóa thành công"
                ],
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'message' => "Có lỗi xảy ra khi xóa sản phẩm",
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

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
                'rates.rate_id'
            )->get();


        if (empty($rates)) {
            return response()->json(
                [
                    'message' => "Sản phẩm chưa có lượt đánh giá nào",
                    'data' => $rates
                ],

            );
        } else {
            $groupedRate = $rates->groupBy('rate_id')->map(function ($rateGroup) {
                $rate = $rateGroup->first();
                return [
                    'fullName' => $rate->fullName,
                    'email' => $rate->email,
                    'product_name' => $rate->product_name,
                    'star' => $rate->star,
                    'content' => $rate->content,
                    'created_at' => $rate->created_at,
                    'images' => $rateGroup->pluck('image_name')->toArray()
                ];
            });
            return response()->json(
                [
                    'message' => "Danh sách đánh giá",
                    'data' => $groupedRate
                ],
                Response::HTTP_OK
            );
        }
    }
}
