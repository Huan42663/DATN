<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(){

        $products = $this->product("","","");
            if(isset($_GET['price'])){
                $prices = explode("-", $_GET['price']);
                $minPrice = $prices[0];
                $maxPrice = $prices[1];
                $products = $this->product("",$minPrice,$maxPrice);
            }
        return View('client.products',compact('products'));
    }
    public function search(){
        $products ="";
       if(isset($_GET['keyword'])){
           $products = $this->product($_GET['keyword'],"","");
           if(isset($_GET['price'])){
                $prices = explode("-", $_GET['price']);
                $minPrice = $prices[0];
                $maxPrice = $prices[1];
                $products = $this->product($_GET['keyword'],$minPrice,$maxPrice);
                // dd($minPrice);
           }
          return View('client.product-search',compact('products'));
       }
       else{
            return redirect()->route('Client.Home');
       }
        
    }
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
        // kiểm tra sản phẩm có tồn tại hay không
        if (empty($product[0])) {
            return response()->json(['errors' => 'không tìm thấy sản phẩm'], Response::HTTP_NOT_FOUND);
        } else {

            // lấy ra giá nhỏ nhất
            $product['0']['min_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->min('product_variant.price');

            // lấy ra giá lớn nhất
            $product['0']['max_price'] = Products::query()
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
            $product_images = Products::query()
                ->where('product_slug', $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->join('colors', 'product_variant.color_id', "=", 'colors.color_id')
                ->join('image_color', 'colors.color_id', "=", 'image_color.color_id')
                ->join('variant_image_color', 'product_variant.product_variant_id', "=", 'variant_image_color.product_variant_id')
                ->select('image_color_name')
                ->get();

            // lấy ra các danh mục của sản phẩm
            $product['0']['categories'] = Products::query()
                ->where('product_slug', $slug)
                ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                ->select(
                    'category_name'
                )
                ->get();

            // lấy ra sản phẩm tương tự
            $count = count($product['0']['categories']);
            $related_products = [];
            for ($i = 0; $i < $count; $i++) {
                $resuilt =  Products::query()
                    ->where('category_name',  "LIKE", $product['0']['categories'][$i]->category_name)
                    ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                    ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                    ->select(
                        'category_name',
                        'product_image',
                        'product_name',
                        'description',
                        'product_slug'
                    )
                    ->get();
                $related_products[$i] = $resuilt;
            }

            // lấy ra danh sách đánh giá
            $rates = Products::query()
                ->where('product_slug', $slug)
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->join('rates', 'product_variant.product_variant_id', '=', 'rates.product_variant_id')
                ->join('users', 'rates.user_id', '=', 'users.user_id')
                ->select(
                    'star',
                    'content',
                    'fullname'
                )
                ->get();

            // lấy ra danh sách ảnh của đánh giá
            $rate_images = Products::query()
                ->where('product_slug', $slug)
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->join('rates', 'product_variant.product_variant_id', '=', 'rates.product_variant_id')
                ->join('rate_image', 'rates.rate_id', '=', 'rate_image.rate_id')
                ->select(
                    'image_name'
                )
                ->get();

            //  trả về dữ liệu dưới dạng json
            return response()->json(
                [
                    'product' => $product,
                    'product_variant' => $product_variant,
                    'product_images' => $product_images,
                    'related_products' => $related_products,
                    'rates' => $rates,
                    'rate_images' => $rate_images,
                ],
                Response::HTTP_OK
            );
        }
    }
    function product($keyword,$minPrice,$maxPrice){
        $product = "";
        if(empty($keyword) && empty($minPrice) && empty($maxPrice)){
            $product = Products::query()
                        ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                        ->where('products.status',1)
                        ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                        ->groupBy('products.product_id','products.product_name', 'products.product_image', 'product_slug')
                        ->orderBy('products.product_id','desc')
                        ->get();
        }
        if(empty($keyword) && $minPrice>=0 && $maxPrice>=0){
            $product = Products::query()
                        ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                        ->where('products.status',1)
                        ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                        ->groupBy('products.product_id','products.product_name', 'products.product_image', 'product_slug')
                        ->havingRaw("maxPrice >= $minPrice AND maxPrice <= $maxPrice")
                        // ->having("maxPrice"," <= ",$maxPrice)
                        ->orderBy('products.product_id','desc')
                        ->get();
        }
        if(!empty($keyword) && empty($minPrice) && empty($maxPrice)){
            $product = Products::query()
                        ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                        ->where('products.status',1)
                        ->where('products.product_name','LIKE',"%".$keyword."%")
                        ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                        ->groupBy('products.product_id','products.product_name', 'products.product_image', 'product_slug')
                        ->orderBy('products.product_id','desc')
                        ->get();
        }
        if(!empty($keyword) && $minPrice>=0 && $maxPrice>=0){
            $product = Products::query()
                    ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                    ->where('products.status',1)
                    ->where('products.product_name','LIKE',"%".$keyword."%")
                    ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                    ->groupBy('products.product_id','products.product_name', 'products.product_image', 'product_slug')
                    ->havingRaw("maxPrice >= $minPrice AND maxPrice <= $maxPrice")
                    // ->having("maxPrice"," <= ",$maxPrice)
                    ->orderBy('products.product_id','desc')
                    ->get();
            
        }
        return $product;
    }
}
