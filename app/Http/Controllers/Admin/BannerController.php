<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    public function showBanner(){
        return view('admin.banners.index');
    }
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

            // Kiểm tra và thiết lập giá trị cho link
            if (empty($request->link)) {
                if (!empty($request->event_id) && empty($request->product_id)) {
                    // Nếu chỉ có event_id, gán link là slug của event_id
                    $validatedData['link'] = url('/events/' . $request->event_id); // Ví dụ link theo slug của event
                } elseif (empty($request->event_id) && !empty($request->product_id)) {
                    // Nếu chỉ có product_id, gán link là slug của product_id
                    $validatedData['link'] = url('/products/' . $request->product_id); // Ví dụ link theo slug của product
                } elseif (empty($request->event_id) && empty($request->product_id)) {
                    // Nếu không có cả event_id và product_id, gán link là danh sách sản phẩm
                    $validatedData['link'] = url('/api/client/products');
                } else {
                    // Nếu có cả event_id và product_id nhưng không nhập link, báo lỗi
                    return response()->json([
                        'message' => 'Link is required when both event_id and product_id are provided.',
                        'errors' => [
                            'link' => 'This field is required if both event_id and product_id are provided.'
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
    public function update(Request $request, $id)
    {
        try {
            // Tìm banner cần cập nhật
            $banner = Banner::findOrFail($id);

            // Lấy dữ liệu từ request và bỏ qua những trường không có giá trị
            $validatedData = $request->validate([
                'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'nullable|boolean',
                'event_id' => 'nullable|integer',
                'product_id' => 'nullable|integer',
                'link' => 'nullable|string|url'
            ]);

            // Kiểm tra và thiết lập giá trị cho link nếu chưa có
            if (empty($request->link)) {
                if (!empty($request->event_id) && empty($request->product_id)) {
                    // Nếu chỉ có event_id, gán link là slug của event_id
                    $validatedData['link'] = url('/events/' . $request->event_id);
                } elseif (empty($request->event_id) && !empty($request->product_id)) {
                    // Nếu chỉ có product_id, gán link là slug của product_id
                    $validatedData['link'] = url('/products/' . $request->product_id);
                } elseif (empty($request->event_id) && empty($request->product_id)) {
                    // Nếu không có cả event_id và product_id, gán link là danh sách sản phẩm
                    $validatedData['link'] = url('/api/client/products');
                }
            }

            // Xử lý upload file ảnh nếu có file mới được upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/banners'), $imageName);
                $validatedData['image_name'] = $imageName; // Cập nhật tên file trong DB
            }

            // Cập nhật các trường hợp có trong validatedData vào banner
            // $banner->update(array_filter($validatedData));
            $banner->update($validatedData);

            // Trả về phản hồi JSON
            return response()->json([
                'message' => 'Banner đã được cập nhật thành công',
                'data' => $banner
            ], Response::HTTP_OK); // Trạng thái 200
        } catch (ValidationException $e) {
            // Trả về phản hồi JSON với thông tin lỗi
            return response()->json([
                'message' => 'Validation errors',
                'errors' => $e->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY); // Trạng thái 422
        }
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
