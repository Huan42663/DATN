<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    public function index(){
        $data = Banner::query()->get();
            return response()->json(
                [
                    'message' => "Danh sách Banner",
                    'data' => $data
                ],
                Response::HTTP_OK
        );
    }
    public function show($id)
    {
        // Tìm banner theo banner_id
        $banner = Banner::where('banner_id', $id)->first();

        // Kiểm tra nếu banner không tồn tại
        if (!$banner) {
            return response()->json([
                'message' => 'Banner không tồn tại'
            ], 404);
        }

        // Trả về dữ liệu banner
        return response()->json([
            'message' => 'Chi tiết Banner',
            'data' => $banner
        ], 200);
    }
    // public function store(Request $request)
    // {
    //     // Xác thực dữ liệu
    //     $validatedData = $request->validate([
    //         'image_name' => 'required|string|max:255',
    //         'status' => 'required|boolean',
    //         'event_id' => 'nullable|integer',
    //         'product_id' => 'nullable|integer',
    //         'link' => 'nullable|string|url'
    //     ]);

    //     // Tạo banner mới trong cơ sở dữ liệu
    //     $banner = Banner::create($validatedData);

    //     // Trả về phản hồi JSON
    //     return response()->json([
    //         'message' => 'Banner đã được tạo thành công',
    //         'data' => $banner
    //     ], Response::HTTP_CREATED); // Trạng thái 201
    // }
    public function store(Request $request)
    {
        try {
            // Xác thực dữ liệu
            $validatedData = $request->validate([
                'image_name' => 'required|string|max:255',
                'status' => 'required|boolean',
                'event_id' => 'nullable|integer',
                'product_id' => 'nullable|integer',
                'link' => 'nullable|string|url'
            ]);

            // Tạo banner mới trong cơ sở dữ liệu
            $banner = Banner::create($validatedData);

            // Trả về phản hồi JSON
            return response()->json([
                'message' => 'Banner đã được tạo thành công',
                'data' => $banner
            ], Response::HTTP_CREATED); // Trạng thái 201
        } catch (ValidationException $e) {
            // Trả về phản hồi JSON với thông tin lỗi
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // Trạng thái 422
        }
    }
    public function update(Request $request, $banner_id)
    {
        // Xác thực dữ liệu
        $validatedData = $request->validate([
            'image_name' => 'sometimes|required|string|max:255',
            'status' => 'sometimes|required|integer|in:0,1',
            'event_id' => 'nullable|integer',
            'product_id' => 'nullable|integer',
            'link' => 'nullable|string|url'
        ]);

        // Tìm banner theo banner_id
        $banner = Banner::where('banner_id', $banner_id)->first();

        // Kiểm tra nếu banner không tồn tại
        if (!$banner) {
            return response()->json([
                'message' => 'Banner không tồn tại.'
            ], 404);
        }

        // Cập nhật banner với dữ liệu mới
        $banner->update($validatedData);

        // Trả về phản hồi JSON
        return response()->json([
            'message' => 'Banner đã được cập nhật thành công',
            'data' => $banner
        ], Response::HTTP_OK); // Trạng thái 200
    }
    public function destroy($banner_id)
    {
        // Xóa banner theo banner_id
        $deleted = Banner::where('banner_id', $banner_id)->delete();

        // Kiểm tra xem có bản ghi nào bị xóa hay không
        if ($deleted) {
            return response()->json([
                'message' => 'Banner đã được xóa thành công'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'Banner không tồn tại'
            ], 404);
        }
    }
}
