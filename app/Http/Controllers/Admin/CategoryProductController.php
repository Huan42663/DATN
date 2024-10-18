<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categoryProducts = CategoryProduct::all();
        return response()->json(['categoryProducts' => $categoryProducts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->only(['category_id', 'product_id']);

        $categoryProduct = CategoryProduct::create($data);

        return response()->json(['categoryProduct' => $categoryProduct], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $categoryProduct = CategoryProduct::find($id);

        if (!$categoryProduct) {
            return response()->json(['message' => 'Không tìm thấy Danh mục sản phẩm'], 404);
        }

        return response()->json(['categoryProduct' => $categoryProduct], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $categoryProduct = CategoryProduct::find($id);

        if (!$categoryProduct) {
            return response()->json(['message' => 'Không tìm thấy danh mục sản phẩm'], 404);
        }

        $categoryProduct->update($request->only('category_id', 'product_id'));

        return response()->json(['categoryProduct' => $categoryProduct], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoryProduct = CategoryProduct::find($id);

        if (!$categoryProduct) {
            return response()->json(['message' => 'Không tìm thấy danh mục sản phẩm']);
        }

        $categoryProduct->delete();

        return response()->json(['message' => 'Xóa danh mục sản phẩm thành công']);
    }
}
