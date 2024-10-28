<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Psy\Exception\ThrowUpException;
use Throwable;

use function PHPUnit\Framework\throwException;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categoryProducts = Category::all();
        return response()->json(['categoryProducts' => $categoryProducts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'category_name' => 'required|string|max:255',
            'category_parent_id' => 'nullable|exists:categories,category_id'
        ]);

        $categoryProduct = Category::create($validatedData);

        return response()->json(
            [
                'message' => 'Danh mục sản phẩm đã được tạo thành công',
                'categoryProduct' => $categoryProduct
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        try {
            $categoryProducts = Category::query()->join('categories as c', 'categories.category_id', '=', 'c.category_parent_id')
                ->join('categories as cp', 'c.category_parent_id', '=', 'cp.category_id')
                ->select('c.category_id', 'c.category_name', 'cp.category_name as category_parent')
                ->where('c.category_id', $id)
                ->get();
            $count = Count($categoryProducts);
            if ($count > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết Danh mục sản phẩm",
                        'data' => $categoryProducts
                    ]
                );
            } else {
                return response()->json(
                    ['message' => "Không tìm thấy Danh mục sản phẩm"],
                    Response::HTTP_NOT_FOUND
                );
            }
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['message' => "Không tìm thấy Danh mục sản phẩm"],
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

        try {
            $categoryProduct = Category::query()->where('category_id', $id);

            $data = $request->validate([
                'category_name' => 'required|string|max:255',
                'category_parent_id' => 'nullable|exists:categories,category_id'
            ]);

            $categoryProduct->update($data);
            return response()->json(['message' => 'update thanh cong'], Response::HTTP_OK);
        } catch (Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryProduct = Category::where('category_id', $id)->delete();

        if ($categoryProduct) {
            return response()->json(
                [
                    'message' => 'Danh mục sản phẩm đã được xóa thành công'
                ],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                [
                    'error' => 'Danh mục sản phẩm không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
