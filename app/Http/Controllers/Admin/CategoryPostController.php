<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryPost;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

class CategoryPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categoryPosts = CategoryPost::query()->get();

        return response()->json(
            [
                'message' => "Danh mục Bài viết",
                'data' => $categoryPosts
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate(['category_post_name' => 'required|string|max:255']);

        $categoryPost = CategoryPost::create($validatedData);

        return response()->json(
            [
                'message' => 'Danh mục bài viết đã được tạo thành cônng',
                'data' => $categoryPost
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = CategoryPost::query()->where("category_post_id", '=', $id)->get();
            $count = Count($data);
            if ($count > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết danh mục Bài viết",
                        'data' => $data
                    ]
                );
            } else {
                return response()->json(

                    ['error' => "Không tìm thấy"],
                    Response::HTTP_NOT_FOUND
                );
            }
        } catch (\Throwable $th) {
            FacadesLog::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['error' => "Không tìm thấy"],
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

        $categoryPost = CategoryPost::where('category_post_id', $id);

        $validatedData = $request->validate(['category_post_name' => 'required|string|max:255']);

        $categoryPost->update($validatedData);

        return response()->json(
            [
                'message' => 'Danh mục bài viết đã được cập nhật thành công!!',
                'data' => $categoryPost
            ],
            Response::HTTP_OK
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoryPost = CategoryPost::where('category_post_id', $id)->delete();

        if ($categoryPost) {
            return response()->json(
                [
                    'message' => 'Danh mục Bài viết đã được xóa thành công'
                ],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                [
                    'error' => 'Danh mục Bài viết không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
