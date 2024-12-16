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
        $category_post = CategoryPost::query()->orderByDesc('category_post_id')->get();
        return view('admin.post-categories.index', compact('category_post'));
    }

    public function create()
    {
        return view('admin.post-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $slug = Str::slug($request->category_post_name);
    //     $request->validate(
    //         [
    //             'category_post_name' => 'required|unique:category_post,category_post_name|string|max:255',
    //         ],
    //         [
    //             'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
    //             'category_post_name.unnique' => 'Tên của danh mục bài viết đã tồn tại',
    //             'category_post_name.string' => 'Tên danh mục bài viết phải là một chuỗi',
    //             'category_post_name.max' => 'Tên danh mục bài viết không được dài quá 255 ký tự',
    //         ]
    //     );
    //     $data = $request->except('_token', '_method', 'example_length', 'category_post');
    //     $data['category_post_slug'] = $slug;
    //     $data['showHeader'] = $request->has('showHeader') ? 1 : 0;
    //     $data['showFooter'] = $request->has('showFooter') ? 1 : 0;

    //     $category_post = CategoryPost::query()->create($data);

    //     return redirect()->route('Administration.categoryPost.list')->with('message', 'Đã thêm danh mục bài viết thành công');
    // }
    public function store(Request $request)
    {
        $request->validate(
            [
                'category_post_name' => 'required|unique:category_post,category_post_name|string|max:255',
            ],
            [
                'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
                'category_post_name.unique' => 'Tên của danh mục bài viết đã tồn tại',
                'category_post_name.string' => 'Tên danh mục bài viết phải là một chuỗi',
                'category_post_name.max' => 'Tên danh mục bài viết không được dài quá 255 ký tự',
            ]
        );

        $checkText = new PostController();
        $check = $checkText->ValidateText($request['category_post_name']);

        if ($check === false) {
            $_SESSION['category_post_name'] = $request['category_post_name'];

            return redirect()->back()->with('error', 'Tên danh mục bài viết không được chứa ký tự đặc biệt');
        }

        $slug = Str::slug($request->category_post_name);
        $data = $request->except('_token', '_method', 'example_length', 'category_post');
        $data['category_post_slug'] = $slug;
        $data['showHeader'] = $request->has('showHeader') ? 1 : 0;
        $data['showFooter'] = $request->has('showFooter') ? 1 : 0;

        CategoryPost::query()->create($data);

        unset($_SESSION['category_post_name']);
        return redirect()->route('Administration.categoryPost.list')->with('message', 'Đã thêm danh mục bài viết thành công');
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
        $category_post = CategoryPost::where('category_post_id', $id)->first();
        $listCategoryPost = CategoryPost::query()->where('category_post_id', "!=", $id)->get();

        if (empty($category_post)) {
            return view('error-404', ['message' => "Không tìm thấy danh mục sản phẩm"]);
        }

        foreach ($listCategoryPost as $value) {
            if ($value->category_post_name == $request->category_post_name) {
                return view('admin.post-categories.update', [
                    'data' => $category_post,
                    'message' => "The category name is duplicated"
                ]);
            }
        }

        $checkText = new PostController();
        $check = $checkText->ValidateText($request->category_post_name);

        if ($check === false) {
            return redirect()->back()->with('error', 'Tên danh mục bài viết không được chứa ký tự đặc biệt');
        }

        $request->validate(
            [
                'category_post_name' => 'required|unique:category_post,category_post_name,' . $id . ',category_post_id|string|max:255',
            ],
            [
                'category_post_name.required' => 'The article category name cannot be empty',
                'category_post_name.unique' => 'The name of the article category already exists',
                'category_post_name.max' => 'The article category name cannot be larger than 255 characters',
            ]
        );

        $data = $request->except('_token', '_method', 'example_length', 'category_post');
        $data['category_post_slug'] = Str::slug($request->category_post_name);
        $data['showHeader'] = $request->has('showHeader') ? 1 : 0;
        $data['showFooter'] = $request->has('showFooter') ? 1 : 0;

        CategoryPost::query()->where('category_post_id', $id)->update($data);

        return redirect()->route('Administration.categoryPost.list')->with('message', 'Updated article list successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category_post = CategoryPost::query()->where('category_post_id', '=', $id)->delete();
        if (!$category_post) {
            return view('error-404', compact(['error' => 'No find product categories']));
        } else {
            return redirect()->route('Administration.categoryPost.list')->with('message', 'Successfully deleted article category');
        }
    }

    public function listCategoryPostDelete()
    {
        $category_post = CategoryPost::onlyTrashed()->get();
        return view('admin.post-categories.listDelete', compact('category_post'));
    }

    public function restoreCategoryPost(Request $request)
    {
        if (isset($request->category_post_id) && !empty($request->category_post_id)) {
            foreach ($request->category_post_id as $item) {
                $category_post = CategoryPost::withTrashed()->where('category_post_id', $item)->get();
                if (isset($category_post) && count($category_post) > 0) {
                    CategoryPost::withTrashed()->where('category_post_id', $item)->restore();
                }
            }

            return redirect()->route('Administration.categoryPost.list')
                ->with('message', 'Restore article category successfully');
        }

        return redirect()->route('Administration.categoryPost.list')
            ->with('message', 'No categories selected');
    }
}
