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
        $min_price = Products::query()
            ->where('product_slug', "=", $slug)
            ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
            ->min('product_variant.price');
        $max_price = Products::query()
            ->where('product_slug', "=", $slug)
            ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
            ->max('product_variant.price');
        $product = Products::query()
            ->where('product_slug', $slug)
            ->select(
                'product_image',
                'product_name',
                'description'
            )
            ->get();
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
        $images = Products::query()
            ->where('product_slug', $slug)
            ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
            ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
            ->join('image_color', 'colors.color_id', "=", 'image_color.color_id')
            ->join('variant_image_color', 'product_variant.product_variant_id', "=", 'variant_image_color.product_variant_id')
            ->select('image_color_name')
            ->get();
        $product['0']['min_price'] = $min_price;
        $product['0']['max_price'] = $max_price;
        return response()->json(['product_variant' => $product_variant,  'product' => $product, 'images' => $images], Response::HTTP_OK);
    }
}
