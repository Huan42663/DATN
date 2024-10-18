<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Http\Request;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categoryPosts = CategoryPost::all();

        return response()->json(['data' => $categoryPosts], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate(['category_post_name' => 'required|string|max:255']);

        $categoryPost = CategoryPost::create($validatedData);

        return response()->json(['data' => $categoryPost], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $categoryPost = CategoryPost::find($id);

        if (!$categoryPost) {
            return response()->json(['message' => 'Không tìm thấy danh mục Bài viết']);
        }

        return response()->json(['data' => $categoryPost], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $categoryPost = CategoryPost::find($id);

        if (!$categoryPost) {
            return response()->json(['message' => 'Không tìm thấy danh mục Bài viết']);
        }

        $validatedData = $request->validate(['category_post_name' => 'required|string|max:255']);

        $categoryPost->update($validatedData);

        return response()->json(['data' => $categoryPost], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $categoryPost = CategoryPost::find($id);

        if (!$categoryPost) {
            return response()->json(['message' => 'Không tìm thấy danh mục Bài viết']);
        }

        $categoryPost->delete();

        return response()->json(['message' => 'Xóa danh mục bài viết thành công!']);
    }
}
