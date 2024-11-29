<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function getProductsByCategory(string $slug)
    {
        // Lấy các sản phẩm theo danh mục
        $products = Products::query()
            ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
            ->where('categories.category_slug', '=', $slug)
            ->select([
                'products.product_image',
                'products.product_name',
                'products.description',
                'products.product_slug',
            ])
            ->get();

        // Kiểm tra danh mục có tồn tại hay không
        if ($products->isEmpty()) {
            return response()->json(
                ['errors' => 'Không tìm thấy sản phẩm trong danh mục này'],
                Response::HTTP_NOT_FOUND
            );
        }

        // Lấy giá nhỏ nhất và giá lớn nhất
        foreach ($products as $product) {
            $product->min_price = Products::query()
                ->where('product_slug', $product->product_slug)
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->min('product_variant.price');

            $product->max_price = Products::query()
                ->where('product_slug', $product->product_slug)
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->max('product_variant.price');
        }

        // trả về dữ liệu Json
        return response()->json(
            [
                'products' => $products
            ],
            Response::HTTP_OK
        );
    }
}
