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
        $data = CategoryPost::query()->get();
        return response()->json(
            [
                'message' => "Danh mục Bài viết",
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
        $slug = Str::slug($request->category_post_name);

        // Xác thực dữ liệu
        $validator = Validator::make(
            $request->all(),
            [
                'category_post_name' => 'required|string|max:255',
            ],
            [
                'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
                'category_post_name.string' => 'Tên danh mục bài viết phải là chuỗi',
                'category_post_name.max' => 'Tên danh mục bài viết không được lớn hơn 255 ký tự',
            ]
        );

        // Xử lý lỗi xác thực
        if ($validator->fails()) {
            return response()->json([
                'data' => [
                    'errors' => $validator->errors(),
                ],
                'status' => Response::HTTP_BAD_REQUEST,
            ]);
        }

        // Tạo mới danh mục và trả về JSON thành công
        try {
            $categoryPost = CategoryPost::create(array_merge(
                $request->all(),
                ['category_post_slug' => $slug]
            ));

            return response()->json([
                'data' => [
                    'message' => 'Danh mục bài viết đã được tạo thành công',
                    'data' => $categoryPost,
                ],
                'status' => Response::HTTP_CREATED,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'data' => [
                    'message' => 'Đã xảy ra lỗi khi tạo danh mục',
                    'error' => $e->getMessage(),
                ],
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
            $category_post = CategoryPost::query()
                ->where('category_post_slug', $slug)
                ->select(
                    'category_post_name'
                )
                ->get();
            return response()->json(
                [
                    'message' => 'Chi tiết danh mục bài viết',
                    'data' => $category_post
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
        $categoryPost = CategoryPost::where('category_post_id', $id)->get();
        $categoryPost = CategoryPost::query()->where('category_post_id', $id)->get();
        $listCategoryPost = CategoryPost::query()->where('category_post_id', "!=", $id)->get();
        if (empty($categoryPost[0])) {
            return response()->json(['message' => 'Không tìm thấy danh mục Bài viết'], Response::HTTP_BAD_REQUEST);
        } else {
            foreach ($listCategoryPost as $value) {
                if ($value->category_post_name == $request->category_post_name) {
                    return response()->json(['errors' => "Tên danh mục bài viết bị trùng", 'data' => $categoryPost], Response::HTTP_BAD_REQUEST);
                } else {
                    $request['category_post_slug'] = Str::slug($request->category_post_name);
                    $validator = Validator::make(
                        $request->all(),
                        [
                            'category_post_name' => 'required|string|max:255',
                        ],
                        [
                            'category_post_name.required' => 'Tên danh mục bài viết không được để trống',
                            'category_post_name.max' => 'Tên danh mục bài viết không được lớn hơn 255 ký tự',
                        ]
                    );
                    if ($validator->fails()) {
                        return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
                    } else {
                        CategoryPost::query()->where('category_post_id', $id)->update($request->all());
                        return response()->json([
                            'message' => 'Danh mục bài viết được cập nhật thành công',
                            'data' => CategoryPost::query()->where('category_post_id', $id)->get()
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
        $data = CategoryPost::query()->where('category_post_id', '=', $id)->delete();
        if (!$data) {
            return response()->json(
                [
                    'error' => "Không tìm thấy danh mục bài viết"
                ],
                Response::HTTP_NOT_FOUND
            );
        } else {
            return response()->json(
                [
                    'message' => "Xóa danh mục bài viết thành công"
                ],
                Response::HTTP_OK
            );
        }
    }
}
