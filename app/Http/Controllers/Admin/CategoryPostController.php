<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;




class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $category_post = CategoryPost::query()->get();
        return view('admin.post-categories.index', compact('category_post'));
    }

    public function create()
    {
        return view('admin.post-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->category_post_name);
        // dd($request->all());

        // Xác thực dữ liệu
        $request->validate(
            [
                'category_post_name' => 'required|string|max:255',
            ],
            [
                'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
                'category_post_name.string' => 'Tên danh mục bài viết phải là chuỗi',
                'category_post_name.max' => 'Tên danh mục bài viết không được lớn hơn 255 ký tự',
            ]
        );
        $data = $request->except('_token', '_method', 'example_length', 'category_post');
        $data['category_post_slug'] = $slug;
        $data['showHeader'] = $request->has('showHeader') ? 1 : 0;
        $data['showFooter'] = $request->has('showFooter') ? 1 : 0;

        $category_post = CategoryPost::query()->create($data);

        return redirect()->route('Administration.categoryPost.list')->with('message', 'thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $category_post = CategoryPost::query()
            ->where('category_post_slug', $slug)
            ->select(
                'category_post_name'
            )
            ->get();
        return view('admin.post-categories.show', compact('category_post'));
    }

    public function edit($id)
    {
        $category_post = CategoryPost::where('category_post_id', $id)->first();;
        return view('admin.post-categories.update', compact('category_post'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category_post = CategoryPost::where('category_post_id', $id)->get();
        $category_post = CategoryPost::query()->where('category_post_id', $id)->get();
        $listCategoryPost = CategoryPost::query()->where('category_post_id', "!=", $id)->get();
        if (empty($category_post[0])) {
            return view('error-404', compact(['errors' => "Không tìm thấy danh mục sản phẩm"]));
        } else {
            foreach ($listCategoryPost as $value) {
                if ($value->category_post_name == $request->category_post_name) {
                    return view('admin.post-categories.update', compact(['data' => $category_post, 'errors' => "Tên danh mục bị trùng"]));
                } else {
                    $request['category_post_slug'] = Str::slug($request->category_post_name);
                    $request->validate(
                        [
                            'category_post_name' => 'required|string|max:255',
                        ],
                        [
                            'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
                            'category_post_name.max' => 'Tên danh mục bài viết không được lớn hơn 255 ký tự',
                        ]
                    );
                }
                $data = $request->except('_token', '_method', 'example_length', 'category_post');
                $data['showHeader'] = $request->has('showHeader') ? 1 : 0;
                $data['showFooter'] = $request->has('showFooter') ? 1 : 0;

                $category_post = CategoryPost::query()->where('category_post_id', $id)->update($data);

                return redirect()->route('Administration.categoryPost.list')->with('message', 'Cập nhật thành công');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category_post = CategoryPost::query()->where('category_post_id', '=', $id)->delete();
        if (!$category_post) {
            return view('error-404', compact(['error' => 'không tìm danh mục sản phẩm']));
        } else {
            return redirect()->route('Administration.categoryPost.list')->with('message', 'Xóa danh mục bài viết thành công');
        }
    }
}
