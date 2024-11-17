<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Event;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::query()
            ->leftJoin('events', 'events.event_id', '=', 'banners.event_id')
            ->leftJoin('products', 'products.product_id', '=', 'banners.product_id')
            ->select(
                'banners.banner_id',
                'image_name',
                'banners.status',
                'product_name',
                'event_name'
            )
            ->get();

        // Trả về view và truyền dữ liệu vào
        return view('admin.banners.index', compact('banners'));
    }
    public function create()
    {
        $products = Products::all();
        $events = Event::all();
        return view('admin.banners.create', compact('products', 'events'));
    }
    // public function show($id)
    // {
    //     // Tìm banner theo banner_id
    //     $banner = Banner::where('banner_id', $id)->first();

    //     // Kiểm tra nếu banner không tồn tại
    //     if (!$banner) {
    //         return response()->json([
    //             'message' => 'Banner không tồn tại'
    //         ], 404);
    //     }

    //     // Trả về dữ liệu banner
    //     return response()->json([
    //         'message' => 'Chi tiết Banner',
    //         'data' => $banner
    //     ], 200);
    // }
    public function store(Request $request)
    {
        // Validate input
        $request->validate(
            [
                'image_name' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'event_id' => ['nullable', 'exists:events,event_id', Rule::prohibitedIf($request->has("product_id"))], // event_id phải tồn tại trong bảng events
                'product_id' => ['nullable', 'exists:products,product_id', Rule::prohibitedIf($request->has("event_id"))], // product_id phải tồn tại trong bảng products
            ],
            [
                'image_name.required' => 'ảnh không được để trống',
                'image_name.image' => 'ảnh không đúng định dạng',
                'image_name.mimes' => 'ảnh không đúng định dạng',
                'image_name.max' => 'kích thước ảnh tối đa là 2048mb',
                'event_id.exists' => 'sự kiện không tồn tại',
                'product_id.exists' => 'sản phẩm không tồn tại',
            ]
        );
        $link = null;
        if ($request->event_id) {
            $event = Event::where('event_id', $request->event_id)->first();
            $link = url('/events/detail-' . $event->slug);
        }
        if ($request->product_id) {
            $product = Products::where('product_id', $request->product_id)->first();
            $link = url('/products/detail-' . $product->product_slug);
        }
        if ($request->event_id == null && $request->product_id == null) {
            $link = url('/products');
        }


        // Upload the image
        $imagePath = null;
        if ($request->hasFile('image_name')) {
            $imagePath = $request->file('image_name')->store('uploads');
        }
        // Create a new Banner
        Banner::create([
            'image_name' => $imagePath,
            'event_id' => $request->event_id,
            'product_id' => $request->product_id,
            'link' => $link
        ]);

        return redirect()
            ->route('Administration.banners.index')
            ->with('message', 'Banner đã được thêm thành công!');
    }
    public function edit(string $id)
    {
        $events = Event::all();
        $products = Products::all();
        $banner = Banner::where('banner_id', $id)->first();
        // dd($banner);
        return view('admin.banners.update', compact('events', 'products', 'banner'));
    }
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        // Validate input
        $request->validate(
            [
                'image_name' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'event_id' => [
                    'nullable',
                    'exists:events,event_id',
                    Rule::prohibitedIf($request->filled('product_id')), // event_id không được tồn tại nếu product_id có dữ liệu
                ],
                'product_id' => [
                    'nullable',
                    'exists:products,product_id',
                    Rule::prohibitedIf($request->filled('event_id')), // product_id không được tồn tại nếu event_id có dữ liệu
                ],
            ],
            [
                'image_name.image' => 'Ảnh không đúng định dạng',
                'image_name.mimes' => 'Ảnh không đúng định dạng',
                'image_name.max' => 'Kích thước ảnh tối đa là 2048MB',
                'event_id.exists' => 'Sự kiện không tồn tại',
                'product_id.exists' => 'Sản phẩm không tồn tại',
                'event_id.prohibited' => 'Không thể chọn cả sự kiện và sản phẩm cùng lúc.',
                'product_id.prohibited' => 'Không thể chọn cả sự kiện và sản phẩm cùng lúc.',
            ]
        );

        // Handle image upload
        if ($request->hasFile('image_name')) {
            // Delete old image if exists
            if ($banner->image_name && Storage::exists($banner->image_name)) {
                Storage::delete($banner->image_name);
            }

            // Save new image
            $imagePath = $request->file('image_name')->store('uploads');
            $banner->image_name = $imagePath;
        }

        // Update link logic
        if ($request->event_id) {
            $event = Event::where('event_id', $request->event_id)->first();
            $banner->link = url('/events/detail-' . $event->slug);
            $banner->event_id = $request->event_id;
            $banner->product_id = null; // Clear product_id if event_id is set
        } elseif ($request->product_id) {
            $product = Products::where('product_id', $request->product_id)->first();
            $banner->link = url('/products/detail-' . $product->product_slug);
            $banner->product_id = $request->product_id;
            $banner->event_id = null; // Clear event_id if product_id is set
        }

        // Save the updated banner
        $banner->save();

        return redirect()
            ->route('Administration.banners.index')
            ->with('message', 'Banner đã được cập nhật thành công!');
    }
    public function destroy($id)
    {
        try {
            // Tìm banner theo ID
            $banner = Banner::findOrFail($id);

            // Xóa file hình ảnh nếu tồn tại
            if ($banner->image_name && Storage::exists($banner->image_name)) {
                Storage::delete($banner->image_name);
            }

            // Xóa banner khỏi database
            $banner->delete();

            // Trả về thông báo thành công
            return redirect()
                ->route('Administration.banners.index')
                ->with('message', 'Banner đã được xóa thành công!');
        } catch (\Exception $e) {
            // Trả về thông báo lỗi nếu xảy ra lỗi trong quá trình xóa
            return redirect()
                ->route('Administration.banners.index')
                ->with('error', 'Không thể xóa banner: ' . $e->getMessage());
        }
    }
}
