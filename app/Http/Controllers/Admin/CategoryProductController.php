<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Throwable;

use function PHPUnit\Framework\throwException;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::query()->get();
        return response()->json(
            [
                'message' => "Danh sách danh mục sản phẩm",
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name);
        $validator = Validator::make(
            $request->all(),
            [
                'category_name' => "required|unique:categories,category_name",
                'category_parent_id' => "nullable|exists:categories,category_id"
            ],
            [
                "category_name.required" => "Tên danh mục sản phẩm không được để trống",
                "category_name.unique" => "Tên danh mục sản phẩm đã có",
            ]
        );
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], Response::HTTP_BAD_REQUEST);
        } else {
            $categoryProduct = Category::create($request->all());
            return response()->json(
                [
                    'message' => "Thêm danh mục sản phẩm thành công",
                    'data' => $categoryProduct
                ],
                Response::HTTP_CREATED
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $category_products = Category::query()
                ->where('category_slug', $slug)
                ->select(
                    'category_name',
                    'category_parent_id'
                )
                ->get();
            return response()->json(
                [
                    'message' => "Chi tiết danh mục sản phẩm",
                    'data' => $category_products
                ]
            );
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['error' => "Không tìm thấy danh mục Bài viết"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoryProduct = Category::query()->where('category_id', $id)->get();
        $listCategoryProduct = Category::query()->where('category_id', "!=", $id)->get();
        if (empty($categoryProduct[0])) {
            return response()->json(['message' => 'Không tìm thấy danh mục Sản phẩm'], Response::HTTP_NOT_FOUND);
        } else {
            foreach ($listCategoryProduct as $value) {
                if ($value->category_name == $request->category_name) {
                    return response()->json(['errors' => "Tên danh mục sản phẩm bị trùng", 'data' => $categoryProduct], Response::HTTP_NOT_FOUND);
                } else {
                    $request['category_slug'] = Str::slug($request->category_name);
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'category_name' => "required|unique:categories,category_name",
                            'category_parent_id' => "nullable|exists:categories,category_id"
                        ],
                        [
                            "category_name.required" => "Tên danh mục sản phẩm không được để trống",
                            "category_name.unique" => "Tên danh mục sản phẩm đã có",
                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
                    } else {
                        Category::query()->where('category_id', $id)->update($request->all());
                        return response()->json([
                            'message' => 'Danh mục sản phẩm đã được cập nhật thành công',
                            'data' => Category::query()->where('category_id', $id)->get()
                        ], Response::HTTP_OK);
                    }
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Category::query()->where('category_id', '=', $id)->delete();
        if (!$data) {
            return response()->json(
                [
                    'error' => "Không tìm thấy danh mục sản phẩm"
                ],
                Response::HTTP_NOT_FOUND
            );
        } else {
            return response()->json(
                [
                    'message' => "Xóa danh mục sản phẩm thành công"
                ],
                Response::HTTP_OK
            );
        }
    }
}
