<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Color;
use App\Models\ImageColor;
use App\Models\ProductEvent;
use App\Models\Products;
use App\Models\ProductVariant;
use App\Models\CartDetail;
use App\Models\Rate;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_id,products.product_name,products.status ,products.product_image,product_slug,Max(product_variant.price) as maxPrice , Min(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.status', 'products.product_image', 'product_slug')
            ->orderBy('product_id', 'desc')
            ->get();
        return view('admin.products.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $sizes = Size::all();
        $colors = Color::all();
        $categories = Category::query()->where('category_parent_id', null)->get();
        $cate_children = Category::query()->get();

        return view('admin.products.create', compact('sizes', 'colors', 'categories', 'cate_children'));
    }

    public function createVariant()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create-variants', compact('sizes', 'colors'));
    }

    public function createVariantUpdate()
    {
        $sizes = Size::all();
        $colors = Color::all();
        return view('admin.products.create-variant-update', compact('sizes', 'colors'));
    }

    public function createVariantUpdate1(Request $request)
    {
        $request->validate([
            'colors' => 'required|array|min:1',
            'colors.*' => 'exists:colors,color_id',
            'sizes' => 'required|array|min:1',
            'sizes.*' => 'exists:sizes,size_id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|lte:price',
            'quantity' => 'required|integer|min:1',
            'weight' => 'required|numeric|min:0',
        ], [
            'colors.required' => 'Vui lòng chọn ít nhất một màu.',
            'colors.array' => 'Dữ liệu không hợp lệ. Vui lòng chọn màu hợp lệ.',
            'colors.*.exists' => 'Màu không tồn tại trong hệ thống.',
            'sizes.required' => 'Vui lòng chọn ít nhất một kích thước.',
            'sizes.array' => 'Dữ liệu không hợp lệ. Vui lòng chọn kích thước hợp lệ.',
            'sizes.*.exists' => 'Kích thước không tồn tại trong hệ thống.',
            'price.required' => 'Vui lòng nhập giá.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
            'sale_price.required' => 'Vui lòng nhập giá khuyến mãi.',
            'sale_price.numeric' => 'Giá khuyến mãi phải là một số.',
            'sale_price.lte' => 'Giá khuyến mãi không được lớn hơn giá gốc.',
            'quantity.required' => 'Vui lòng nhập số lượng.',
            'quantity.integer' => 'Số lượng phải là một số nguyên.',
            'quantity.min' => 'Số lượng không được nhỏ hơn 1.',
            'weight.required' => 'Vui lòng nhập khối lượng.',
            'weight.numeric' => 'Khối lượng phải là một số.',
            'weight.min' => 'Khối lượng không được nhỏ hơn 0.',
        ]);


        $data = [];
        $i = 0;
        $check = "";
        $sizes = Size::all();
        $colors = Color::all();

        if (isset($request['action'])) {
            $check = $request['action'];
        }
        // FULL SIZE AND COLOR================================================================================================================================================================================== 
        if (!empty($request['sizes']) && $request['sizes'][0] == 0 && !empty($request['colors']) && $request['colors'][0] == 0) {
            foreach ($sizes as $size) {
                foreach ($colors as $color) {
                    $data[] = [
                        'stt' => $i,
                        'action' => $check,
                        'product_id' => $_SESSION['product_id'],
                        'size_id' => $size,
                        'color_id' => $color,
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }
        }

        // FULL SIZE AND NOT FULL COLOR
        else if (!empty($request['sizes']) && $request['sizes'][0] == 0) {
            // MANY CHOOSE COLOR
            if (!empty($request['colors']) && $request['colors'][0] != 0) {
                foreach ($sizes as $size) {
                    foreach ($request['colors'] as $color) {
                        $data[] = [
                            'stt' => $i,
                            'action' => $check,
                            'product_id' => $_SESSION['product_id'],
                            'size_id' => $size,
                            'color_id' => $color,
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }
            // NO CHOOSE COLOR
            else if (empty($request['colors'])) {
                foreach ($sizes as $size) {
                    $data[] = [
                        'stt' => $i,
                        'action' => $check,
                        'product_id' => $_SESSION['product_id'],
                        'size_id' => $size,
                        'color_id' => '',
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }
        }

        // FULL COLOR AND NOT FULL SIZE
        else if (!empty($request['colors']) && $request['colors'][0] == 0) {
            // MANY CHOOSE SIZE
            if (!empty($request['sizes']) && $request['sizes'][0] != 0) {
                foreach ($request['sizes'] as $size) {
                    foreach ($colors as $color) {
                        $data[] = [
                            'stt' => $i,
                            'action' => $check,
                            'product_id' => $_SESSION['product_id'],
                            'size_id' => $size,
                            'color_id' => $color,
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }
            // NO CHOOSE SIZE
            else if (empty($request['sizes'])) {
                foreach ($colors as $color) {
                    $data[] = [
                        'stt' => $i,
                        'action' => $check,
                        'product_id' => $_SESSION['product_id'],
                        'size_id' => '',
                        'color_id' => $color,
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }
        }

        // END FULL  =================================================================================================================

        // CHOOSE MANY OR NOT SIZE AND COLOR ========================================================================================= 

        // CHOOSE MANY SIZE AND COLOR
        else if (!empty($request['sizes']) && $request['sizes'][0] != 0 && !empty($request['colors']) && $request['colors'][0] != 0) {
            foreach ($request['sizes'] as $size) {
                foreach ($request['colors'] as $color) {
                    $data[] = [
                        'stt' => $i,
                        'action' => $check,
                        'product_id' => $_SESSION['product_id'],
                        'size_id' => $size,
                        'color_id' => $color,
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }
        }

        // CHOOSE MANY SIZE AND CHOOSE NOT COLOR
        else if (!empty($request['sizes']) && $request['sizes'][0] != 0 && empty($request['colors'])) {
            foreach ($request['sizes'] as $size) {
                $data[] = [
                    'stt' => $i,
                    'action' => $check,
                    'product_id' => $_SESSION['product_id'],
                    'size_id' => $size,
                    'color_id' => '',
                    'price' => $request['price'],
                    'sale_price' => $request['sale_price'],
                    'quantity' => $request['quantity'],
                    'weight' => $request['weight']
                ];
                $i++;
            }
        }

        // CHOOSE MANY COLOR AND CHOOSE NOT SIZE
        else if (!empty($request['colors']) && $request['colors'][0] != 0 && empty($request['sizes'])) {
            foreach ($request['colors'] as $color) {
                $data[] = [
                    'stt' => $i,
                    'action' => $check,
                    'product_id' => $_SESSION['product_id'],
                    'size_id' => '',
                    'color_id' => $color,
                    'price' => $request['price'],
                    'sale_price' => $request['sale_price'],
                    'quantity' => $request['quantity'],
                    'weight' => $request['weight']
                ];
                $i++;
            }
        }

        // END CHOOSE MANY OR NOT SIZE AND COLOR ========================================================================================= 






        // if (isset($request['sizes'])  && ($request['colors']) && $request['sizes'][0] != 0 && $request['colors'][0] != 0) {
        //     foreach ($request['sizes'] as $size) {
        //         foreach ($request['colors'] as $color) {
        //             $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => $size, "color_id" => $color, 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //             $i++;
        //         }
        //     }
        // } else if (isset($request['sizes']) && !isset($request['colors']) && $request['sizes'][0] != 0 && $request['colors'][0] != 0) {
        //     foreach ($request['sizes'] as $size) {
        //         $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => $size, "color_id" => "", 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //         $i++;
        //     }
        // } else if (!isset($request['sizes']) && isset($request['colors']) && $request['sizes'][0] != 0 && $request['colors'][0] != 0) {
        //     foreach ($request['colors'] as $color) {
        //         $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => "", "color_id" => $color, 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //         $i++;
        //     }
        // } else if (isset($request['sizes']) && isset($request['colors']) && $request['sizes'][0] == 0 && $request['colors'][0] == 0) {

        //     foreach ($sizes as $size) {
        //         foreach ($colors as $color) {
        //             $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => $size->size_id, "color_id" => $color->color_id, 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //             $i++;
        //         }
        //     }
        // } else if (isset($request['sizes']) && isset($request['colors']) && $request['sizes'][0] == 0 && $request['colors'][0] != 0) {
        //     foreach ($sizes as $size) {
        //         $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => $size->size_id, "color_id" => "", 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //         $i++;
        //     }
        // } else if (isset($request['sizes']) && isset($request['colors']) && $request['sizes'][0] != 0 && $request['colors'][0] == 0) {
        //     foreach ($colors as $color) {
        //         $data[] = ['stt' => $i, 'action' => $check, 'product_id' => $_SESSION['product_id'], "size_id" => "", "color_id" => $color->color_id, 'price' => $request['price'], 'sale_price' => $request['sale_price'], 'quantity' => $request['quantity'], 'weight' => $request['weight']];
        //         $i++;
        //     }
        // }
        $_SESSION['data'] = $data;
        // dd( $_SESSION['data']);
        return view('admin.products.create-variants', compact('sizes', 'colors'));
    }

    public function createVariant1(Request $request)
    {
        if (isset($request['action'])) {
            foreach ($request['stt'] as $item) {
                unset($_SESSION['data'][$item]);
            }
            $sizes = Size::all();
            $colors = Color::all();
            return view('admin.products.create-variants', compact('sizes', 'colors'));
        }
        // dd($_SESSION['data']);
        foreach ($_SESSION['data'] as $item) {
            unset($item['stt']);
            if (empty($item['size_id'])) {
                unset($item['size_id']);
            }
            if (empty($item['color_id'])) {
                unset($item['color_id']);
            }
            ProductVariant::create($item);
        }
        return redirect()->route('Administration.products.create')->with('message', 'Thêm sản phẩm thành công');
    }
    public function createVariant2(Request $request)
    {
        if (isset($request['action'])) {
            foreach ($request['stt'] as $item) {
                unset($_SESSION['data'][$item]);
            }
            $sizes = Size::all();
            $colors = Color::all();
            return view('admin.products.create-variants', compact('sizes', 'colors'));
        }
        $product = Products::query()->where('product_id', $_SESSION['data'][0]['product_id'])->first();
        // dd($_SESSION['data']);
        foreach ($_SESSION['data'] as $item) {
            unset($item['stt']);
            unset($item['action']);

            // Kiểm tra xem biến thể đã tồn tại chưa
            $check = ProductVariant::query()
                ->where('product_id', $item['product_id'])
                ->where('size_id', $item['size_id'])
                ->where('color_id', $item['color_id'])
                ->get();

            if (count($check) > 0) {
                $data = [
                    'price' => $item['price'],
                    'sale_price' => $item['sale_price'],
                    'quantity' => $item['quantity']
                ];

                ProductVariant::query()
                    ->where('product_id', $item['product_id'])
                    ->where('size_id', $item['size_id'])
                    ->where('color_id', $item['color_id'])
                    ->update($data);
            } else {
                $create = ProductVariant::create($item);
                $checkNoVariant = ProductVariant::where('product_id',$create->product_id)->where('size_id',null)->where('color_id',null)->first();
                if($checkNoVariant != null){
                    ProductVariant::where('product_id',$create->product_id)->where('size_id',null)->where('color_id',null)->delete();
                }
            }
            
            // $product = Products::query()->where('product_id', $item['product_id'])->get();
            // return redirect()->route('Administration.products.show', $product->product_slug)->with('message', 'Thêm biến thể thành công');

        }
        return redirect()->route('Administration.products.show', $product->product_slug)
            ->with('message', 'Thêm biến thể thành công!');
    }

    public function deleteVariant(Request $request)
    {
        if (isset($request->delete) && isset($request->variant_id)) {
            foreach ($request['variant_id'] as $item) {
                $check = Count(ProductVariant::where('product_id', $request->product_id)->get());
                $variant = ProductVariant::find($item);
                $cart = CartDetail::where('product_variant_id', $variant->product_variant_id)->get();
                foreach ($cart as $itemCart) {
                    CartDetail::where('cart_detail_id', $itemCart->cart_detail_id)->delete();
                }
                if ($check == 1) {
                    return redirect()->back()->with('error', 'Không thể xóa toàn bộ biến thể ');
                } else {
                    $variant->delete();
                }
            }
            return redirect()->back()->with('message', 'Xóa biến thể thành công');
        } else {
            unset($_SESSION['error']);
            $error = [];
            for ($i = 0; $i < count($request->variant_id_update); $i++) {
                $data = [
                    'size_id' => $request->size_id[$i],
                    'color_id' => $request->color_id[$i],
                    'price' => $request->price[$i],
                    'sale_price' => $request->sale_price[$i],
                    'quantity' => $request->quantity[$i],
                ];
                if ($request->price[$i] < 0 || $request->sale_price[$i] < 0 || $request->quantity[$i] < 0) {
                    return redirect()->back()->with('error', "Giá , giá khuyến mãi và số lượng không được nhỏ hơn 0");
                }
                $check  = ProductVariant::leftJoin('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
                    ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
                    ->where('product_variant.product_variant_id', '=', $request->variant_id_update[$i])
                    ->first();
                // dd($check);
                //lấy id biến thể được update rồi so sánh với tất cả biến thể trừ id biến thể được lấy
                // dd($check);
                $check1 = ProductVariant::leftJoin('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
                    ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
                    ->where('product_variant.size_id', $request->size_id[$i])
                    ->where('product_variant.color_id', $request->color_id[$i])
                    ->where('product_variant.product_id', $request->product_id)
                    ->where('product_variant.product_variant_id', '!=', $request->variant_id_update[$i])
                    ->first();
                if ($check1 != null) {
                    $size = $check->size_name;
                    $color = $check->color_name;
                    $error[] = " size: $size, màu: $color thành size: $check1->size_name, màu: $check1->color_name";
                } else {
                    $check->update($data);
                }
            }
            if (empty($error)) {
                return redirect()->back()->with('message', 'Cập nhật biến thể thành công');
            } else {
                $_SESSION['error'] = $error;
                return redirect()->back();
            }
        }
    }



    public function store(Request $request)
    {
        // dd($request->all());
        // Tạo slug cho sản phẩm
        $productSlug = Str::slug($request->product_name);

        // Validate dữ liệu
        $request->validate(
            [
                'category_id' => 'required|exists:categories,category_id',
                'product_name' => [
                    'required',
                    'min:5',
                    Rule::unique('products', 'product_name')
                        ->whereNull('deleted_at')
                ],

                'price' => 'required|numeric|min:1|max:100000000',
                'sale_price' => 'nullable|numeric|min:0|lte:price',
                'quantity' => 'required|integer|min:1|max:1000',
                'weight' => 'required|numeric|min:0.01|max:500',
                'status' => 'required|in:1,2',
                'product_image' => 'required',
                'description' => 'required|string|min:10|max:5000',
                'colors' => 'nullable|array',
                'sizes' => 'nullable|array',
            ],
            [
                'category_id.required' => 'Vui lòng chọn một danh mục.',
                'category_id.exists' => 'Danh mục bạn chọn không tồn tại.',
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã tồn tại',
                'product_name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
                'status.required' => 'Trạng thái không được để trống',
                'price.required' => 'Giá sản phẩm là bắt buộc.',
                'price.numeric' => 'Giá sản phẩm phải là một số.',
                'price.min' => 'Giá sản phẩm không được nhỏ hơn :min.',
                'price.max' => 'Giá sản phẩm không được lớn hơn :max.',
                'sale_price.required' => 'Giá khuyến mãi là bắt buộc.',
                'sale_price.numeric' => 'Giá khuyến mãi phải là một số.',
                'sale_price.min' => 'Giá khuyến mãi không được nhỏ hơn :min.',
                'sale_price.lte' => 'Giá khuyến mãi phải nhỏ hơn hoặc bằng giá sản phẩm.',
                'quantity.required' => 'Số lượng là bắt buộc.',
                'quantity.integer' => 'Số lượng phải là số nguyên.',
                'quantity.min' => 'Số lượng không được nhỏ hơn :min.',
                'quantity.max' => 'Số lượng không được lớn hơn :max.',
                'weight.required' => 'Khối lượng là bắt buộc.',
                'weight.numeric' => 'Khối lượng phải là một số.',
                'weight.min' => 'Khối lượng không được nhỏ hơn :min.',
                'weight.max' => 'Khối lượng không được lớn hơn :max.',
                'product_image.required' => 'Hình ảnh sản phẩm không được để trống',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'description.string' => 'Mô tả sản phẩm phải là một chuỗi văn bản hợp lệ',
                'description.min' => 'Mô tả sản phẩm phải có ít nhất 10 ký tự',
                'description.max' => 'Mô tả sản phẩm không được vượt quá 5000 ký tự',
            ]
        );
        // Xử lý hình ảnh sản phẩm và lưu vào storage
        $imageName = null;

        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $path_image = $file[0]->store('products');
            $imageName = $path_image;
        }

        $product = Products::create(
            $request->only([
                'product_name',
                'description',
                'status',
            ]) + [
                'product_slug' => $productSlug,
                'product_image' => $imageName,
            ]
        );


        if (isset($request['category_id'])) {
            foreach ($request['category_id'] as $item) {
                CategoryProduct::create(
                    ['category_id' => $item, 'product_id' => $product->product_id,]
                );
            }
        }


        if ($request->hasFile('product_image')) {
            $file = $request->file('product_image');
            $i = 0;
            foreach ($file as $key) {
                if ($i != 0) {
                    $path_image = $key->store('products');
                    $data = ['product_id' => $product->product_id, 'image_color_name' => $path_image];
                    ImageColor::create($data);
                }
                $i++;
            }
        }

        $sizes = Size::query()->pluck('size_id')->toArray();
        $colors = Color::query()->pluck('color_id')->toArray();
        $data = [];
        $i = 0;

        if (empty($request['sizes']) && empty($request['colors'])) {
            $dataVariant = [
                'product_id' => $product->product_id,
                'price' => $request->price,
                'sale_price' => $request['sale_price'],
                'quantity' => $request['quantity'],
                'weight' => $request['weight']
            ];
            ProductVariant::create($dataVariant);
            return redirect()->route('Administration.products.create')
                ->with('message', 'Sản phẩm đã được thêm thành công nhưng chưa có biến thể');
        } else {

            // FULL SIZE AND COLOR================================================================================================================================================================================== 

            if (!empty($request['sizes']) && $request['sizes'][0] == 0 && !empty($request['colors']) && $request['colors'][0] == 0) {
                foreach ($sizes as $size) {
                    foreach ($colors as $color) {
                        $data[] = [
                            'stt' => $i,
                            'product_id' => $product->product_id,
                            'size_id' => $size,
                            'color_id' => $color,
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }

            // FULL SIZE AND NOT FULL COLOR
            else if (!empty($request['sizes']) && $request['sizes'][0] == 0) {
                // MANY CHOOSE COLOR
                if (!empty($request['colors']) && $request['colors'][0] != 0) {
                    foreach ($sizes as $size) {
                        foreach ($request['colors'] as $color) {
                            $data[] = [
                                'stt' => $i,
                                'product_id' => $product->product_id,
                                'size_id' => $size,
                                'color_id' => $color,
                                'price' => $request['price'],
                                'sale_price' => $request['sale_price'],
                                'quantity' => $request['quantity'],
                                'weight' => $request['weight']
                            ];
                            $i++;
                        }
                    }
                }
                // NO CHOOSE COLOR
                else if (empty($request['colors'])) {
                    foreach ($sizes as $size) {
                        $data[] = [
                            'stt' => $i,
                            'product_id' => $product->product_id,
                            'size_id' => $size,
                            'color_id' => '',
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }

            // FULL COLOR AND NOT FULL SIZE
            else if (!empty($request['colors']) && $request['colors'][0] == 0) {
                // MANY CHOOSE SIZE
                if (!empty($request['sizes']) && $request['sizes'][0] != 0) {
                    foreach ($request['sizes'] as $size) {
                        foreach ($colors as $color) {
                            $data[] = [
                                'stt' => $i,
                                'product_id' => $product->product_id,
                                'size_id' => $size,
                                'color_id' => $color,
                                'price' => $request['price'],
                                'sale_price' => $request['sale_price'],
                                'quantity' => $request['quantity'],
                                'weight' => $request['weight']
                            ];
                            $i++;
                        }
                    }
                }
                // NO CHOOSE SIZE
                else if (empty($request['sizes'])) {
                    foreach ($colors as $color) {
                        $data[] = [
                            'stt' => $i,
                            'product_id' => $product->product_id,
                            'size_id' => '',
                            'color_id' => $color,
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }

            // END FULL  =================================================================================================================

            // CHOOSE MANY OR NOT SIZE AND COLOR ========================================================================================= 

            // CHOOSE MANY SIZE AND COLOR
            else if (!empty($request['sizes']) && $request['sizes'][0] != 0 && !empty($request['colors']) && $request['colors'][0] != 0) {
                foreach ($request['sizes'] as $size) {
                    foreach ($request['colors'] as $color) {
                        $data[] = [
                            'stt' => $i,
                            'product_id' => $product->product_id,
                            'size_id' => $size,
                            'color_id' => $color,
                            'price' => $request['price'],
                            'sale_price' => $request['sale_price'],
                            'quantity' => $request['quantity'],
                            'weight' => $request['weight']
                        ];
                        $i++;
                    }
                }
            }

            // CHOOSE MANY SIZE AND CHOOSE NOT COLOR
            else if (!empty($request['sizes']) && $request['sizes'][0] != 0 && empty($request['colors'])) {
                foreach ($request['sizes'] as $size) {
                    $data[] = [
                        'stt' => $i,
                        'product_id' => $product->product_id,
                        'size_id' => $size,
                        'color_id' => '',
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }

            // CHOOSE MANY COLOR AND CHOOSE NOT SIZE
            else if (!empty($request['colors']) && $request['colors'][0] != 0 && empty($request['sizes'])) {
                foreach ($request['colors'] as $color) {
                    $data[] = [
                        'stt' => $i,
                        'product_id' => $product->product_id,
                        'size_id' => '',
                        'color_id' => $color,
                        'price' => $request['price'],
                        'sale_price' => $request['sale_price'],
                        'quantity' => $request['quantity'],
                        'weight' => $request['weight']
                    ];
                    $i++;
                }
            }

            // END CHOOSE MANY OR NOT SIZE AND COLOR ========================================================================================= 




            // //  FULL SIZE VÀ COLOR
            // if (!empty($request['sizes']) && $request['sizes'][0] == 0 && !empty($request['colors']) && $request['colors'][0] == 0) {
            //     foreach ($sizes as $size) {
            //         foreach ($colors as $color) {
            //             $data[] = [
            //                 'stt' => $i,
            //                 'product_id' => $product->product_id,
            //                 'size_id' => $size,
            //                 'color_id' => $color,
            //                 'price' => $request['price'],
            //                 'sale_price' => $request['sale_price'],
            //                 'quantity' => $request['quantity'],
            //                 'weight' => $request['weight']
            //             ];
            //             $i++;
            //         }
            //     }
            // } else if (!empty($request['sizes']) && $request['sizes'][0] == 0) {
            //     // FULL SIZE, COLOR TỰ CHỌN
            //     if (!empty($request['colors'])  && $request['colors'][0] != 0) {
            //         foreach ($sizes as $size) {
            //             foreach ($request['colors'] as $color) {
            //                 $data[] = [
            //                     'stt' => $i,
            //                     'product_id' => $product->product_id,
            //                     "size_id" => $size,
            //                     "color_id" => $color,
            //                     'price' => $request['price'],
            //                     'sale_price' => $request['sale_price'],
            //                     'quantity' => $request['quantity'],
            //                     'weight' => $request['weight']
            //                 ];
            //                 $i++;
            //             }
            //         }
            //     }
            //     // FULL SIZE COLOR NULL
            //     else {
            //         foreach ($sizes as $size) {
            //             $data[] = [
            //                 'stt' => $i,
            //                 'product_id' => $product->product_id,
            //                 'size_id' => $size,
            //                 'color_id' => '',
            //                 'price' => $request['price'],
            //                 'sale_price' => $request['sale_price'],
            //                 'quantity' => $request['quantity'],
            //                 'weight' => $request['weight']
            //             ];
            //             $i++;
            //         }
            //     }
            // }
            // // FULL COLOR
            // else if (!empty($request['colors']) && $request['colors'][0] == 0) {
            //     if (!empty($request['sizes'] && $request['sizes'][0] != 0)) {
            //         // FULL COLOR SIZE TỰ CHỌN
            //         foreach ($colors as $color) {
            //             foreach ($request['sizes'] as $size) {
            //                 $data[] = [
            //                     'stt' => $i,
            //                     'product_id' => $product->product_id,
            //                     'size_id' => $size,
            //                     'color_id' => $color,
            //                     'price' => $request['price'],
            //                     'sale_price' => $request['sale_price'],
            //                     'quantity' => $request['quantity'],
            //                     'weight' => $request['weight']
            //                 ];
            //                 $i++;
            //             }
            //         }
            //     } else {
            //         // FULL MÀU SIZE NULL
            //         foreach ($colors as $color) {
            //             $data[] = [
            //                 'stt' => $i,
            //                 'product_id' => $product->product_id,
            //                 'size_id' => '',
            //                 'color_id' => $color,
            //                 'price' => $request['price'],
            //                 'sale_price' => $request['sale_price'],
            //                 'quantity' => $request['quantity'],
            //                 'weight' => $request['weight']
            //             ];
            //             $i++;
            //         }
            //     }
            // }
            // // CHỌN TỪNG GIÁ TRỊ COLOR VÀ SIZE
            // else {
            //     //COLOR NULL 
            //     if (empty($request['sizes']) && !empty($request['colors'])) {
            //         foreach ($request['colors'] as $color) {
            //             $data[] = [
            //                 'stt' => $i,
            //                 'product_id' => $product->product_id,
            //                 'size_id' => '',
            //                 'color_id' => $color,
            //                 'price' => $request['price'],
            //                 'sale_price' => $request['sale_price'],
            //                 'quantity' => $request['quantity'],
            //                 'weight' => $request['weight']
            //             ];
            //             $i++;
            //         }
            //     }
            //     // SIZE NULL
            //     else if (empty($request['colors']) && !empty($request['sizes'])) {
            //         foreach ($request['sizes'] as $size) {
            //             $data[] = [
            //                 'stt' => $i,
            //                 'product_id' => $product->product_id,
            //                 'size_id' => $size,
            //                 'color_id' => '',
            //                 'price' => $request['price'],
            //                 'sale_price' => $request['sale_price'],
            //                 'quantity' => $request['quantity'],
            //                 'weight' => $request['weight']
            //             ];
            //             $i++;
            //         }
            //     }
            //     // SIZE VÀ COLOR KO NULL
            //     else {
            //         foreach ($request['sizes'] as $size) {
            //             foreach ($request['colors'] as $color) {
            //                 $data[] = [
            //                     'stt' => $i,
            //                     'product_id' => $product->product_id,
            //                     'size_id' => $size,
            //                     'color_id' => $color,
            //                     'price' => $request['price'],
            //                     'sale_price' => $request['sale_price'],
            //                     'quantity' => $request['quantity'],
            //                     'weight' => $request['weight']
            //                 ];
            //                 $i++;
            //             }
            //         }
            //     }
            // }
        }
        $_SESSION['data'] = $data;
        return redirect()->route('Administration.products.create-variant');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $data1 =
            Products::query()
            ->where('product_slug', $slug)
            ->get();
        $data2 = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->leftJoin('sizes', 'product_variant.size_id', '=', 'sizes.size_id')
            ->leftJoin('colors', 'product_variant.color_id', '=', 'colors.color_id')
            ->select(
                'product_variant.product_variant_id',
                'product_variant.size_id',
                'product_variant.color_id',
                'product_variant.price',
                'product_variant.sale_price',
                'product_variant.quantity',
                'product_variant.weight',
                'sizes.size_name',
                'colors.color_name',
            )
            ->where('products.product_slug', $slug)
            ->where('product_variant.product_id', $data1[0]->product_id)
            ->orderBy('sizes.size_name', 'asc')
            // ->whereNull('product_variant.deleted_at')
            ->get();
        $data3 = ImageColor::where('product_id',  $data1[0]->product_id)->get();

        $data4 = Size::query()->withTrashed()->get();
        $data5 = Color::query()->withTrashed()->get();

        $data6 = Size::query()->get();
        $data7 = Color::query()->get();
        // dd($data2);

        $_SESSION['product_id'] = $data1[0]->product_id;
        if ($data1) {
            return view('admin.products.show', compact('data1', 'data2', 'data3', 'data4', 'data5', 'data6', 'data7'));
        } else {
            return redirect()->back()->with('message', 'Không tìm thấy sản phẩm');
        }
    }


    public function edit($product_slug)
    {
        $product = Products::where('product_slug', $product_slug)->firstOrFail();
        $productVariants = ProductVariant::where('product_id', $product->product_id)->get();
        $sizes = Size::all();
        $colors = Color::all();
        $data6 = CategoryProduct::where('product_id', $product->product_id)->get();
        // dd($data6);
        $categories = Category::query()->where('category_parent_id', null)->get();
        $cate_children = Category::query()->get();

        return view('admin.products.update', compact('product', 'productVariants', 'sizes', 'colors', 'data6', 'categories', 'cate_children'));
    }

    public function update(Request $request, $product_slug)
    {
        $product = Products::where('product_slug', $product_slug)->firstOrFail();
        // Validate dữ liệu
        $request->validate(
            [
                'product_name' => [
                    'required',
                    'min:5',
                    Rule::unique('products', 'product_name')->ignore($product->product_id, 'product_id'),
                ],
                'description' => 'required|string|min:10|max:5000',
                'status' => 'required|in:1,2',
                'product_image' => 'nullable|image|mimes:jpeg,webp,png,jpg',
            ],
            [
                'product_name.required' => 'Tên sản phẩm không được để trống',
                'product_name.unique' => 'Tên sản phẩm đã tồn tại',
                'product_name.min' => 'Tên sản phẩm phải có ít nhất 5 ký tự',
                'description.required' => 'Mô tả sản phẩm không được để trống',
                'description.string' => 'Mô tả sản phẩm phải là một chuỗi văn bản hợp lệ',
                'description.min' => 'Mô tả sản phẩm phải có ít nhất 10 ký tự',
                'description.max' => 'Mô tả sản phẩm không được vượt quá 5000 ký tự',
                'status.required' => 'Trạng thái không được để trống',
                'product_image.image' => 'Hình ảnh sản phẩm phải là một tệp hình ảnh hợp lệ',
                'product_image.mimes' => 'Hình ảnh sản phẩm chỉ chấp nhận định dạng jpeg, png hoặc jpg',
            ]
        );

        $productSlug = Str::slug($request->product_name);
        $data = [
            'product_name' => $request->product_name,
            'product_slug' => $productSlug,
            'description' => $request->description,
            'status' => $request->status,
        ];
        // dd(isset($request->category_id));
        if (!isset($request->category_id)) {
            $count = CategoryProduct::query()->where('product_id', $product->product_id)->get();
            foreach ($count as $item) {
                CategoryProduct::query()->where('category_product_id', $item->category_product_id)->delete();
            }
        } else {
            foreach ($request->category_id as $category) {
                $count = CategoryProduct::query()->where('product_id', $product->product_id)->get();
                foreach ($count as $item) {
                    CategoryProduct::query()->where('category_product_id', $item->category_product_id)->delete();
                }
                foreach ($request['category_id'] as $item) {
                    CategoryProduct::create(
                        ['category_id' => $item, 'product_id' => $product->product_id,]
                    );
                }
            }
        }

        // Xử lý ảnh sản phẩm
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            // Xóa ảnh cũ nếu tồn tại
            if ($product->product_image) {
                $oldImagePath = public_path('storage/products/' . $product->product_image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            // Lưu ảnh mới 
            $imagePath = $image->store('products');
            $data['product_image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('Administration.products.edit', $productSlug)
            ->with('message', 'Cập nhật sản phẩm thành công');
    }


    public function deleteMultiple(Request $request)
    {
        if ($request->has('products') && count($request->input('products')) > 0) {
            $productIds = $request->input('products');
            // Xóa các sản phẩm được chọn
            Products::whereIn('product_id', $productIds)->delete();
            return redirect()->route('Administration.products.list')->with('message', 'Xóa thành công');
        }

        return redirect()->route('Administration.products.list')
            ->with('message', 'Không có sản phẩm nào được chọn sóa.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Products::query()->where('product_id', $id)->first();

            if (!$product) {
                return redirect()->back()->with('error', 'Không thể xóa sản phẩm. Vui lòng thử lại.');
            }

            // Xóa các bản ghi liên quan trước
            ProductEvent::query()->where('product_id', $id)->delete();
            ProductVariant::query()->where('product_id', $id)->delete();

            // Xóa sản phẩm
            Products::query()->where('product_id', $id)->delete();
            return redirect()->back()->with('success', 'Soá thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thể xóa sản phẩm. Vui lòng thử lại.');
        }
    }

    public function listProductDelete()
    {
        $products = Products::query()
            ->join('product_variant', 'products.product_id', '=', 'product_variant.product_id')
            ->where('products.status', 1)
            ->selectRaw('products.product_id,products.product_name,products.status ,products.product_image,product_slug,MIN(product_variant.price) as maxPrice , Max(product_variant.sale_price) as minPrice')
            ->groupBy('products.product_id', 'products.product_name', 'products.status', 'products.product_image', 'product_slug')
            ->orderBy('product_id', 'desc')
            ->onlyTrashed()->get();

        return View('admin.products.listDelete', compact('products'));
    }

    public function restoreProduct(Request $request)
    {
        if (isset($request->product_id) && !empty($request->product_id)) {
            $products = Products::withTrashed()->where('product_id', $request->product_id);
            $products->restore();
            return redirect()->route('Administration.products.list')->with('message', 'Khôi phục sản phẩm thành công');
        } else {
            return redirect()->route('Administration.products.list');
        }
    }

    public function destroyImage(Request $request)
    {
        try {
            $image = ImageColor::query()->where('image_color_id', $request['imageColor'][0])->first();

            if (!$image) {
                return redirect()->back()->with('error', 'Không thể xóa ảnh. Vui lòng thử lại.');
            }

            if (isset($request['imageColor'])) {

                foreach ($request['imageColor'] as $key) {

                    $images = ImageColor::query()->where('image_color_id', $key)->get();
                    // dd($images[0]->image_color_name);
                    if (file_exists('storage/' . $images[0]->image_color_name)) {
                        unlink('storage/' .  $images[0]->image_color_name);
                    }
                    ImageColor::query()->where('image_color_id', $key)->delete();
                }
            }

            return redirect()->back()->with('success', 'xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Không thể xóa sản phẩm. Vui lòng thử lại.');
        }
    }
    public function createListImages(Request $request)
    {
        if (isset($request->imageColor)) {
            if ($request->hasFile('imageColor')) {
                $file = $request->file('imageColor');
                foreach ($file as $key) {
                    $image_name = $key->store('products');
                    $data = ['product_id' => $request->product_id, 'image_color_name' => $image_name];
                    ImageColor::create($data);
                }
            }
        } else {
            return redirect()->back()->with('error', 'Không thể thêm ảnh. Vui lòng thử lại.');
        }
        return redirect()->back()->with('message', 'Thêm ảnh thành công ');
    }

    // Create ImageColor
    public function createImage()
    {
        $productData = $_SESSION['data'];

        return view('admin.products.listImage', compact('productData'));
    }

    public function storeImage(Request $request) {}

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
