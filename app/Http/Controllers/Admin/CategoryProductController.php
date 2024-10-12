<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = Category::query()->get();
        return response()->json(['data' => $data], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $data = $request->only(['category_id', 'product_id']);

        // $categoryProduct = CategoryProduct::create($data);


        // return response()->json(['categoryProduct' => $categoryProduct], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        try {

            $categoryProducts = Category::join('categories as c', 'categories.category_id', '=', 'c.category_parent_id')
                ->join('categories as cp', 'c.category_parent_id', '=', 'cp.category_id')
                ->select('c.category_id', 'c.category_name', 'cp.category_name as category_parent')
                ->get();
            $count = Count($categoryProducts);
            if ($count > 0) {
                return response()->json(
                    [
                        'message' => "Danh mục sản phẩm",
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
        //

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }
}
