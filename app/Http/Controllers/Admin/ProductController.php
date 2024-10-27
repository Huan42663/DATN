<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ImageColor;
use App\Models\ProductEvent;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::query()->get();
        return response()->json(
            $data,
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Tạo slug cho sản phẩm
        $productSlug = Str::slug($request->product_name);
        // Validate
        $validatorProduct = Validator::make(
            $request->all(),
            [
                'product_name' => 'required|min:5|unique:products,product_name',
                'description' => 'required',
                'status' => 'required',
                'product_image' => 'required',
                'variants' => 'required|array',
                'image_color' => 'required|array',
            ],
            [
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã tồn tại',
                'product_name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'product_image.required' => 'Hình ảnh sản phẩm không được để trống',
                'variants.required' => 'Cần có biến thể sản phẩm',
                'variants.array' => 'Biến thể sản phẩm phải là một mảng',
                'image_color.required' => 'Cần có biến thể sản phẩm',
                'image_color.array' => 'Biến thể sản phẩm phải là một mảng',
            ]
        );

        if ($validatorProduct->fails()) {
            return response()->json(['errors' => $validatorProduct->errors()], Response::HTTP_BAD_REQUEST);
        }

        // Kiểm tra từng biến thể sản phẩm
        $variants = $request->variants;
        foreach ($variants as $variant) {
            $validatorProVariant = Validator::make(
                $variant,
                [
                    'size_id' => 'nullable|exists:sizes,size_id',
                    'color_id' => 'nullable|exists:colors,color_id',
                    'price' => 'required|numeric|min:0',
                    'sale_price' => 'nullable|numeric|lte:price',
                    'quantity' => 'required|integer|min:1',
                    'weight' => 'required|numeric|min:0',
                ],
                [
                    'size_id.exists' => 'Kích thước không tồn tại',
                    'color_id.exists' => 'Màu sắc không tồn tại',
                    'price.required' => 'Giá không được để trống',
                    'price.numeric' => 'Giá phải là số',
                    'price.min' => 'Giá phải lớn hơn hoặc bằng 0',
                    'sale_price.numeric' => 'Giá giảm phải là số',
                    'sale_price.lte' => 'Giá giảm phải nhỏ hơn hoặc bằng giá gốc',
                    'quantity.required' => 'Số lượng không được để trống',
                    'quantity.integer' => 'Số lượng phải là số nguyên',
                    'quantity.min' => 'Số lượng phải lớn hơn hoặc bằng 1',
                    'weight.required' => 'Trọng lượng không được để trống',
                    'weight.numeric' => 'Trọng lượng phải là số',
                    'weight.min' => 'Trọng lượng phải lớn hơn hoặc bằng 0',
                ]
            );
            if ($validatorProVariant->fails()) {
                return response()->json(['errors' => $validatorProVariant->errors()], Response::HTTP_BAD_REQUEST);
            }
        }

        $product = Products::create($request->only([
            'product_name',
            'description',
            'status',
            'product_image'
        ]) + ['product_slug' => $productSlug]);

        foreach ($variants as $variant) {
            $variant['product_id'] = $product->product_id;
            ProductVariant::create($variant);
        }

        // Kiểm tra image_color 
        $image_colors = $request->image_color;
        foreach ($image_colors as $key => $color) {
            $validatorColor = Validator::make(
                $color,
                [
                    'color_id' => 'required|exists:colors,color_id',
                    'image_color_name' => 'required|string|max:255',
                ],
                [
                    'color_id.required' => 'Màu sắc không được để trống',
                    'color_id.exists' => 'Màu sắc không tồn tại',
                    'image_color_name.required' => 'Tên màu hình ảnh không được để trống',
                    'image_color_name.string' => 'Tên màu hình ảnh phải là chuỗi',
                    'image_color_name.max' => 'Tên màu hình ảnh không được vượt quá 255 ký tự',
                ]
            );

            if ($validatorColor->fails()) {
                return response()->json(['errors' => $validatorColor->errors()], Response::HTTP_BAD_REQUEST);
            }

            // Gán product_id từ sản phẩm vừa tạo
            $image_colors[$key]['product_id'] = $product->product_id;
        }

        // Lưu image_color
        foreach ($image_colors as $image_color) {
            ImageColor::create($image_color);
        }

        return response()->json(
            [
                'message' => "Thêm sản phẩm thành công",
                'data' => [
                    'product' => $product,
                    'variants' => ProductVariant::where('product_id', $product->product_id)->get(),
                    'image_colors' => ImageColor::where('product_id', $product->product_id)->get(),
                ]
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $data = [
                Products::query()
                    ->where('product_slug', $slug)
                    ->get(),
                Products::query()
                    ->leftJoin('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                    ->select(
                        'product_variant.product_variant_id',
                        'product_variant.size_id',
                        'product_variant.color_id',
                        'product_variant.price',
                        'product_variant.sale_price',
                        'product_variant.quantity',
                        'product_variant.weight'
                    )
                    ->where('product_slug', $slug)
                    ->get(),
                Products::query()
                    ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id') 
                    ->join('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
                    ->select('sizes.size_name')
                    ->where('product_slug', $slug)
                    ->get(),
                Products::query()
                    ->leftJoin('image_color', 'image_color.product_id', '=', 'products.product_id')
                    ->leftJoin('product_variant', 'product_variant.product_id', '=', 'products.product_id') 
                    ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
                    ->select(
                        'colors.color_name',
                        'image_color.image_color_name'
                    )
                    ->where('product_slug', $slug)
                    ->get(),
            ];

            if (count($data[0]) > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết sản phẩm :",
                        'data' => $data,
                    ]
                );
            } else {
                return response()->json(
                    ['message' => "Không tìm thấy sản phẩm"],
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
                    ['message' => "Không tìm thấy sản phẩm"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    
    public function update(Request $request, $product_slug)
    {
        // Tìm sản phẩm theo slug
        $product = Products::where('product_slug', $product_slug)->firstOrFail();
    
        // Tạo slug mới cho sản phẩm
        $productSlug = Str::slug($request->product_name);
    
        // Validate
        $validatorProduct = Validator::make(
            $request->all(),
            [
                'product_name' => 'required|min:5|unique:products,product_name,' . $product->product_id . ',product_id',
                'description' => 'required',
                'status' => 'required',
                'product_image' => 'required',
                'variants' => 'required|array',
                'image_color' => 'required|array',
            ],
            [
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã tồn tại',
                'product_name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'status.required' => 'Trạng thái không được để trống',
                'product_image.required' => 'Hình ảnh sản phẩm không được để trống',
                'variants.required' => 'Cần có biến thể sản phẩm',
                'variants.array' => 'Biến thể sản phẩm phải là một mảng',
                'image_color.required' => 'Cần có biến thể sản phẩm',
                'image_color.array' => 'Biến thể sản phẩm phải là một mảng',
            ]
        );
    
        if ($validatorProduct->fails()) {
            return response()->json(['errors' => $validatorProduct->errors()], Response::HTTP_BAD_REQUEST);
        }
    
        // Cập nhật thông tin sản phẩm
        $product->update($request->only([
            'product_name',
            'description',
            'status',
            'product_image'
        ]) + ['product_slug' => $productSlug]);
    
        // Xử lý các biến thể sản phẩm
        foreach ($request->variants as $variant) {
            $validatorProVariant = Validator::make(
                $variant,
                [
                    'size_id' => 'nullable|exists:sizes,size_id',
                    'color_id' => 'nullable|exists:colors,color_id',
                    'price' => 'required|numeric|min:0',
                    'sale_price' => 'nullable|numeric|lte:price',
                    'quantity' => 'required|integer|min:1',
                    'weight' => 'required|numeric|min:0',
                ]
            );
    
            if ($validatorProVariant->fails()) {
                return response()->json(['errors' => $validatorProVariant->errors()], Response::HTTP_BAD_REQUEST);
            }
    
            // Kiểm tra xem biến thể đã tồn tại hay chưa
            if (isset($variant['variant_id'])) {
                $productVariant = ProductVariant::find($variant['variant_id']);
                if ($productVariant) {
                    $productVariant->update($variant);
                } else {
                    return response()->json(['error' => 'Biến thể không tồn tại.'], Response::HTTP_NOT_FOUND);
                }
            } else {
                $variant['product_id'] = $product->product_id;
                ProductVariant::create($variant);
            }
        }
    
        // Xử lý màu hình ảnh
        foreach ($request->image_color as $color) {
            $validatorColor = Validator::make(
                $color,
                [
                    'color_id' => 'required|exists:colors,color_id',
                    'image_color_name' => 'required|string|max:255',
                ]
            );
    
            if ($validatorColor->fails()) {
                return response()->json(['errors' => $validatorColor->errors()], Response::HTTP_BAD_REQUEST);
            }
    
            // Kiểm tra xem màu hình ảnh đã tồn tại hay chưa
            if (isset($color['image_color_id'])) {
                $imageColor = ImageColor::find($color['image_color_id']);
                if ($imageColor) {
                    $imageColor->update($color);
                } else {
                    return response()->json(['error' => 'Màu hình ảnh không tồn tại.'], Response::HTTP_NOT_FOUND);
                }
            } else {
                $color['product_id'] = $product->product_id;
                ImageColor::create($color);
            }
        }
    
        return response()->json(
            [
                'message' => "Cập nhật sản phẩm thành công",
                'data' => [
                    'product' => $product,
                    'variants' => ProductVariant::where('product_id', $product->product_id)->get(),
                    'image_colors' => ImageColor::where('product_id', $product->product_id)->get(),
                ]
            ],
            Response::HTTP_OK
        );
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Products::query()->where('product_id', $id)->first();

            if (!$product) {
                return response()->json(
                    [
                        'message' => "Không tìm thấy sản phẩm"
                    ],
                    Response::HTTP_NOT_FOUND
                );
            }

            // Xóa các bản ghi liên quan trước
            ProductEvent::query()->where('product_id', $id)->delete();
            ProductVariant::query()->where('product_id', $id)->delete();

            // Xóa sản phẩm
            Products::query()->where('product_id', $id)->delete();
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

    /**
     * Rates the specified resource from storage.
     */
    public function getRates($product_slug)
    {
        $product = Products::where('product_slug', $product_slug)->get();
        if (empty($product[0])) {
            return response()->json(
                [
                    'message' => "Sản phẩm không tồn tại",
                    'data' => $product
                ],
                Response::HTTP_NOT_FOUND
            );
        }

        // Lấy danh sách đánh giá của sản phẩm
        $rates = Rate::query()
            ->leftJoin('rate_image', 'rates.rate_id', '=', 'rate_image.rate_id')
            ->join('users', 'rates.user_id', '=', 'users.user_id')
            ->join('product_variant', 'rates.product_variant_id', '=', 'product_variant.product_variant_id')
            ->join('products', 'product_variant.product_id', '=', 'products.product_id')
            ->where('products.product_slug', $product_slug)
            ->select(
                'users.fullName',
                'users.email',
                'products.product_name',
                'rate_image.image_name',
                'rates.star',
                'rates.content',
                'rates.created_at',
                'rates.rate_id',
                'products.product_id'
            )->get();

        // Kiểm tra nếu không có đánh giá
        if ($rates->isEmpty()) {
            return response()->json(
                [
                    'message' => "Sản phẩm chưa có lượt đánh giá nào",
                    'data' => []
                ],
                Response::HTTP_OK
            );
        }

        // Nhóm các đánh giá theo product_id
        $groupedRates = $rates->groupBy('product_id')->map(function ($rateGroup) {
            return $rateGroup->map(function ($rate) {
                return [
                    'fullName' => $rate->fullName,
                    'email' => $rate->email,
                    'star' => $rate->star,
                    'content' => $rate->content,
                    'created_at' => $rate->created_at,
                    'images' => $rate->image_name ? [$rate->image_name] : []
                ];
            });
        });

        return response()->json(
            [
                'message' => "Danh sách đánh giá",
                'data' => $groupedRates->values()
            ],
            Response::HTTP_OK
        );
    }
}
