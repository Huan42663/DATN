<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function productDetail($slug)
    {
        // lấy ra thông tin của sản phẩm
        $product = Products::query()
            ->where('product_slug', $slug)
            ->select(
                'product_image',
                'product_name',
                'description',
            )
            ->get();
        if (empty($product[0])) {
            return response()->json(['errors' => 'không tìm thấy sản phẩm'], Response::HTTP_NOT_FOUND);
        } else {
            // lấy ra giá nhỏ nhất
            $min_price = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->min('product_variant.price');

            // lấy ra giá lớn nhất
            $max_price = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->max('product_variant.price');
            // lấy ra biến thể của sản phẩm
            $product_variant = Products::query()
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->join('sizes', 'product_variant.size_id', "=", 'sizes.size_id')
                ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                ->where('product_slug', $slug)
                ->select(
                    'price',
                    'sale_price',
                    'quantity',

                    'color_name',
                    'size_name'
                )
                ->get();

            // lấy ra 1 mảng các ảnh của biến thể
            $images = Products::query()
                ->where('product_slug', $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                ->join('image_color', 'colors.color_id', "=", 'image_color.color_id')
                ->join('variant_image_color', 'product_variant.product_variant_id', "=", 'variant_image_color.product_variant_id')
                ->select('image_color_name')
                ->get();

            // lấy ra các danh mục của sản phẩm
            $categories = Products::query()
                ->where('product_slug', $slug)
                ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                ->select(
                    'category_name'
                )
                ->get();

            // lấy ra sản phẩm tương tự
            $count = count($categories);
            $related_products = [];
            for ($i = 0; $i < $count; $i++) {
                $resuilt =  Products::query()
                    ->where('category_name',  "LIKE", $categories[$i]->category_name)
                    ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                    ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                    ->select(
                        'category_name',
                        'product_image',
                        'product_name',
                        'description',
                    )
                    ->get();
                $related_products[$i] = $resuilt;
            }

            $product['0']['min_price'] = $min_price;
            $product['0']['max_price'] = $max_price;
            $product['0']['categories'] = $categories;

            return response()->json(
                [
                    'product' => $product,
                    'product_variant' => $product_variant,
                    'images' => $images,
                    'related_products' => $related_products
                ],
                Response::HTTP_OK
            );
        }
    }
}
