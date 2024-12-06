<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $products = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->selectRaw('products.product_id, products.product_name, products.product_image, product_slug, MAX(product_variant.price) as maxPrice, Max(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
            ->orderBy('products.product_id', 'desc')
            ->get();

        return view('client.category', compact('categories', 'products'));
    }
    public function show($slug)
    {
        $category = Category::where('category_slug', $slug)->firstOrFail();

        $products = Products::query()
            ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
            ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
            ->where('categories.category_slug', $slug)
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->selectRaw('products.product_id, products.product_name, products.product_image, product_slug, MAX(product_variant.price) as maxPrice, Max(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
            ->orderBy('products.product_id', 'desc')
            ->get();
        $categories = Category::all();

        return view('client.categories.show', compact('category', 'products', 'categories'));
    }
}
