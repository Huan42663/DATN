<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index()
    {

        $products = $this->product("", "", "");
        if (isset($_GET['price'])) {
            $prices = explode("-", $_GET['price']);
            $minPrice = $prices[0];
            if (!isset($prices[1])) {
                $maxPrice = 10000000000000;
            } else {
                $maxPrice = $prices[1];
            }
            $products = $this->product("", $minPrice, $maxPrice);
        }
        return View('client.products', compact('products'));
    }
    public function search()
    {
        $products = "";
        if (isset($_GET['keyword'])) {
            $products = $this->product($_GET['keyword'], "", "");
            if (isset($_GET['price'])) {
                $prices = explode("-", $_GET['price']);
                $minPrice = $prices[0];
                $maxPrice = $prices[1];
                $products = $this->product($_GET['keyword'], $minPrice, $maxPrice);
                // dd($minPrice);
            }
            return View('client.product-search', compact('products'));
        } else {
            return redirect()->route('Client.Home');
        }
    }
    public function productDetail($slug)
    {
        // lấy ra thông tin của sản phẩm
        $product = Products::query()
            ->join('product_variant','products.product_id','=','product_variant.product_id')
            ->where('product_slug', $slug)
            ->select('products.*')
            ->first();
        $product1 = ProductVariant::query()
            ->where('product_id', $product->product_id)->sum('quantity');
        // kiểm tra sản phẩm có tồn tại hay không
        if (empty($product)) {
            return view('error-404');
        } else {
            // lấy ra giá nhỏ nhất
            $product['min_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->min('product_variant.sale_price');

            // lấy ra giá lớn nhất
            $product['max_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->max('product_variant.sale_price');
            if( $product['min_price'] >=0 && $product['min_price'] == $product['max_price']){
                $product['max_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->max('product_variant.price');
            }
            else if($product['min_price'] == 0 || $product['min_price'] == null){
                $product['min_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->min('product_variant.price');

            // lấy ra giá lớn nhất
                $product['max_price'] = Products::query()
                ->where('product_slug', "=", $slug)
                ->join('product_variant', 'products.product_id', "=", 'product_variant.product_id')
                ->max('product_variant.price');
            }

            $product['sale_price_check'] = Products::query()
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
                    'product_variant.color_id',
                    'product_variant.size_id',
                    'color_name',
                    'size_name',
                    'product_variant.product_id',
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
            $product['categories'] = Products::query()
                ->where('product_slug', $slug)
                ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                ->select(
                    'category_name',
                    'categories.category_slug',
                    'categories.category_id'
                )
                ->get();

            // lấy ra sản phẩm tương tự
            $count = count($product['categories']);
            $related_products = [];
            for ($i = 0; $i < $count; $i++) {
                $resuilt =  Products::query()
                    ->where('categories.category_id',  "=", $product['categories'][$i]->category_id)
                    ->where('product_slug', '!=', $slug)
                    ->where('status', '=', 1)
                    ->join('category_product', 'products.product_id', '=', 'category_product.product_id')
                    ->join('product_variant', 'product_variant.product_id', '=', 'products.product_id')
                    ->join('categories', 'category_product.category_id', '=', 'categories.category_id')
                    ->selectRaw(
                        'products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice'
                    )
                    ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                    ->limit(8)
                    ->get();
                $related_products[$i] = $resuilt;
            }

            // // lấy ra danh sách đánh giá
            $rates = Products::query()
                ->where('product_slug', $slug)
                ->join('rates', 'products.product_id', '=', 'rates.product_id')
                ->join('users', 'rates.user_id', '=', 'users.user_id')
                ->selectRaw(
                    'rate_id ,star,content,fullName'
                )
                ->groupBy('rate_id')
                ->paginate(8);
                // dd($rates);
            // // lấy ra danh sách ảnh của đánh giá
            $rate_images = Products::query()
                ->where('product_slug', $slug)
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->join('rates', 'product_variant.product_variant_id', '=', 'rates.product_variant_id')
                ->join('rate_image', 'rates.rate_id', '=', 'rate_image.rate_id')
                ->selectRaw(
                    'image_name,rates.rate_id as rate_id'
                )
                ->get();
                
                // dd($related_products);
            return view('client.product-detail', compact(
                'product',
                'product_variant',
                'related_products',
                'product_images',
                'product1',
                'rates',
                'rate_images'
            ));

            //  trả về dữ liệu dưới dạng json
        }
    }
    function product($keyword, $minPrice, $maxPrice)
    {
        $product = "";
        if (empty($keyword) && empty($minPrice) && empty($maxPrice)) {
            $product = Products::query()
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->where('products.status', 1)
                ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                ->orderBy('products.product_id', 'desc')
                ->paginate(12);
        }
        if (empty($keyword) && $minPrice >= 0 && $maxPrice >= 0) {
            $product = Products::query()
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->where('products.status', 1)
                ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                ->havingRaw("maxPrice >= $minPrice AND maxPrice <= $maxPrice")
                // ->having("maxPrice"," <= ",$maxPrice)
                ->orderBy('products.product_id', 'desc')
                ->paginate(12);
        }
        if (!empty($keyword) && empty($minPrice) && empty($maxPrice)) {
            $product = Products::query()
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->where('products.status', 1)
                ->where('products.product_name', 'LIKE', "%" . $keyword . "%")
                ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                ->orderBy('products.product_id', 'desc')
                ->paginate(12);
        }
        if (!empty($keyword) && $minPrice >= 0 && $maxPrice >= 0) {
            $product = Products::query()
                ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
                ->where('products.status', 1)
                ->where('products.product_name', 'LIKE', "%" . $keyword . "%")
                ->selectRaw('products.product_id,products.product_name, products.product_image,product_slug, Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
                ->groupBy('products.product_id', 'products.product_name', 'products.product_image', 'product_slug')
                ->havingRaw("maxPrice >= $minPrice AND maxPrice <= $maxPrice")
                // ->having("maxPrice"," <= ",$maxPrice)
                ->orderBy('products.product_id', 'desc')
                ->paginate(12);
        }
        return $product;
    }
    public function getQuantity(Request $request){
        if($request->size_id != null && $request->color_id == null){
            $quantity = ProductVariant::where('product_id',$request->product_id)->where('size_id',$request->size_id)->selectRaw('sale_price, price, SUM(quantity) as quantity')->groupBy('sale_price','price')->first();
            if($quantity != null){
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là : ".$quantity->quantity,"quantity"=>$quantity,"price"=>$quantity->price,"sale_price"=>$quantity->sale_price],200);
                // return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là : ".$quantity->quantity,"quantity"=>$quantity->quantity,"price"=>$quantity->price,"sale_price"=>$quantity->sale_price],200);
            }else{
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : 0"],404);
            }
        }
        else if($request->size_id == null && $request->color_id != null){
            $quantity = ProductVariant::where('product_id',$request->product_id)->where('color_id',$request->color_id)->selectRaw('sale_price, price, SUM(quantity)')->first();
            if($quantity != null){
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : ".$quantity->quantity,"quantity"=>$quantity,"price"=>$quantity->price,"sale_price"=>$quantity->sale_price],200);
            }else{
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : 0"],404);
            }
            // return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : ".$quantity->quantity,"quantity"=>$quantity,"price"=>$quantity->price,"sale_price"=>$quantity->sale_price],200);
        }
        else if($request->size_id != null && $request->color_id != null){
            $quantity = ProductVariant::where('product_id',$request->product_id)->where('size_id',$request->size_id)->where('color_id',$request->color_id)->selectRaw('sale_price, price, quantity')->first();
            if($quantity != null){
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : ".$quantity->quantity,"quantity"=>$quantity,"price"=>$quantity->price,"sale_price"=>$quantity->sale_price],200);
            }else{
                return response()->json(["data"=>"Số lượng sản phẩm còn trong kho là  : 0"],404);
            }
        }
    }
}
