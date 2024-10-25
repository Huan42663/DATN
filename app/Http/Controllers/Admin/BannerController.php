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
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate file ảnh
                'status' => 'required|boolean',
                'event_id' => 'nullable|integer',
                'product_id' => 'nullable|integer',
                'link' => 'nullable|string|url' // Cho phép null nhưng phải là URL hợp lệ nếu có
            ]);

            // Kiểm tra nếu người dùng không nhập link
            if (empty($request->link)) {
                // Nếu không nhập cả event_id và product_id, gán link là danh sách sản phẩm
                if (empty($request->event_id) && empty($request->product_id)) {
                    $validatedData['link'] = url('/api/admin/products');
                } else {
                    // Nếu có nhập event_id hoặc product_id nhưng không nhập link, báo lỗi
                    return response()->json([
                        'message' => 'Link is required when event_id or product_id is provided.',
                        'errors' => [
                            'link' => 'This field is required if event_id or product_id is provided.'
                        ]
                    ], Response::HTTP_UNPROCESSABLE_ENTITY); // Trạng thái 422
                }
            }

            // Xử lý upload file ảnh
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/banners'), $imageName);
                $validatedData['image_name'] = $imageName; // Lưu tên file vào DB
            }

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
    public function update(Request $request, string $id)
    {
        // Tìm banner theo banner_id
        $banner = Banner::where('banner_id', $id)->first();

        // Kiểm tra nếu banner không tồn tại
        if (!$banner) {
            return response()->json(['message' => 'Không tìm thấy banner'], 404);
        }

        // Cập nhật các trường trong banner từ request
        $banner->status = $request->input('status', $banner->status);
        $banner->event_id = $request->input('event_id', $banner->event_id);
        $banner->product_id = $request->input('product_id', $banner->product_id);
        $banner->link = $request->input('link', $banner->link);

        // Kiểm tra và cập nhật file ảnh nếu có
        if ($request->hasFile('image_name')) {
            // Xóa ảnh cũ nếu cần
            if ($banner->image_name) {
                $oldImagePath = public_path('path/to/images/' . $banner->image_name); // Đảm bảo đường dẫn đúng
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Xóa ảnh cũ
                }
            }

            // Lưu ảnh mới
            $image = $request->file('image_name');
            $imageName = time() . '_' . $image->getClientOriginalName(); // Đặt tên ảnh
            $image->move(public_path('path/to/images'), $imageName); // Đảm bảo đường dẫn đúng
            $banner->image_name = $imageName; // Cập nhật tên ảnh trong banner
        }

        // Lưu lại banner đã cập nhật
        try {
            $banner->update(); // Thực hiện lưu vào cơ sở dữ liệu
        } catch (\Exception $e) {
            // Nếu có lỗi, trả về thông báo lỗi
            return response()->json(['message' => 'Không thể cập nhật banner. Lỗi: ' . $e->getMessage()], 500);
        }

        // Trả về phản hồi JSON
        return response()->json(
            [
                'message' => 'Banner đã được cập nhật thành công!!',
                'data' => $banner // Trả về banner đã cập nhật
            ],
            Response::HTTP_OK // Trạng thái 200
        );
    }
    public function destroy(string $id)
    {
        // Xóa banner theo banner_id
        $deleted = Banner::where('banner_id', $id)->first();

        if ($deleted) {
            // Nếu tìm thấy bản ghi, xóa nó
            $deleted->delete();
            return response()->json(
                [
                    'message' => 'Bài viết đã được xóa thành công'
                ],
                Response::HTTP_OK
            );
        } else {
            // Nếu không tìm thấy bản ghi
            return response()->json(
                [
                    'error' => 'Bài viết không tồn tại'
                ],
                Response::HTTP_NOT_FOUND
            );
        }
    }
}
