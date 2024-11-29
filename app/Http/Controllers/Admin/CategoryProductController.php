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
        $categories = Category::with('parent')->orderByDesc('category_id')->get(); // Lấy danh mục và quan hệ cha
        return view('admin.product-categories.index', compact('categories'));
    }

    public function create()
    {
        $category_product = Category::all();
        return view('admin.product-categories.create', compact('category_product'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['category_slug'] = Str::slug($request->category_name);

        $request->validate(
            [
                'category_name' => 'required|unique:categories,category_name',
                'category_parent_id' => 'nullable|exists:categories,category_id', // Thay id bằng category_id
            ],
            [
                'category_name.required' => 'Tên danh mục sản phẩm không được để trống',
                'category_name.unique' => 'Tên danh mục sản phẩm đã có',
            ]
        );

        $data = $request->except(['_token', '_method']);
        $data['category_parent_id'] = $request->category_parent_id ?? null; // Gán parent_id là null nếu không chọn

        $category = Category::create($data);

        return redirect()
            ->route('Administration.categoryProduct.list')
            ->with('message', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $categories = Category::query()
            ->where('category_slug', $slug)
            ->select(
                'category_name',
                'category_parent_id'
            )
            ->get();
        return view('admin.product-categories.show', compact([
            'message' => 'Chi tiết danh mục sản phẩm',
            'categoryProduct' => $categories
        ]));
    }

    public function edit(string $id)
    {
        $categories = Category::find($id);
        if (!$categories) {
            return view('error-404', ['errors' => 'Không tìm thấy danh mục sản phẩm']);
        }

        $listCategoryProduct = Category::where('category_id', '!=', $id)->get();

        return view('admin.product-categories.update', compact('categories', 'listCategoryProduct'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return view('error-404', ['errors' => "Không tìm thấy danh mục sản phẩm"]);
        }

        $listCategoryProduct = Category::where('category_id', '!=', $id)->get();

        $existingCategory = Category::where('category_name', $request->category_name)
            ->where('category_id', '!=', $id)
            ->first();

        if ($existingCategory) {
            return view('admin.product-categories.update', [
                'categories' => $category,
                'listCategoryProduct' => $listCategoryProduct,
                'errors' => "Tên danh mục bị trùng",
            ]);
        }

        $request['category_slug'] = Str::slug($request->category_name);

        $request->validate(
            [
                'category_name' => "required|unique:categories,category_name,{$id},category_id",
                'category_parent_id' => "nullable|exists:categories,category_id",
            ],
            [
                "category_name.required" => "Tên danh mục sản phẩm không được để trống",
                "category_name.unique" => "Tên danh mục sản phẩm đã có",
            ]
        );

        $data = $request->except('_token', '_method', 'example_length', 'category_product');
        $category->update($data);

        return redirect()->route('Administration.categoryProduct.list')->with('message', 'Cập nhật thành công');
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::query()->where('category_id', '=', $id)->delete();
        if (!$categories) {
            return view('error-404', compact(['error' => 'không tìm danh mục sản phẩm']));
        } else {
            return redirect()->route('Administration.categoryProduct.list')->with('message', 'Xóa danh mục sản phẩm thành công');
        }
    }
}
