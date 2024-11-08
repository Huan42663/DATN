<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Event::all();
        return view('admin.events.index', compact(['data' => $data]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        return view('admin.events.create');
    }
    public function store(Request $request)
    {
        // tự động tạo slug theo tên sự kiện
        $request['slug'] = Str::slug($request->event_name);
        // validate form
        $validator = Validator::make(
            $request->all(),
            [
                'event_name' => 'required|min:5|unique:events,event_name',
                'date_start' => 'required',
                'date_end' => 'required',
                'type_event' => 'required'

            ],
            [
                'event_name.required' => 'tên sự kiện không được để trống',
                'event_name.unique' => 'tên sự kiện đã bị trùng',
                'date_start.required' => 'thời gian bắt đầu không được để trống',
                'date_end.required' => 'thời gian kết thúc không được để trống',
                'event_name.min' => 'tên sự kiện không được nhỏ hơn 5 ký tự',
                'type_event.required' => 'kiểu sự kiện không được để trống'
            ]

        );
        // check validate fails nếu không có thì thêm vào bảng event
        if ($validator->fails()) {
            return view('admin.events.create', compact(['errors' => $validator->errors()]));
        } else {
            $event = Event::create($request->all());
            return view('admin.events.index', compact(['event' => $event, 'message' => 'thêm thành công']));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        // lấy ra sự kiện theo slug
        $event = Event::query()
            ->where('slug', $slug)
            ->select(
                'event_name',
                'date_start',
                'date_end',
                'type_event',
                'discount',
                'status',
                'created_at',
                'updated_at'
            )
            ->get();
        // lấy ra mảng sản phẩm của sự kiện
        $products = Event::query()
            ->where('slug', $slug)
            ->join('product_event', 'product_event.event_id', '=', 'events.event_id')
            ->join('products', 'products.product_id', '=', 'product_event.product_id')
            ->select(
                'product_name',
                'product_image'
            )
            ->get();
        // trả về mảng các giá trị dưới dạng json
        return view(
            'admin.banners.show',
            compact(
                [
                    'message' => 'chi tiết sự kiện',
                    'event' => $event,
                    'products' => $products
                ]
            )
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // lấy ra sự kiện theo id
        $event = Event::query()->where('event_id', $id)->get();

        // lấy ra list sự kiện trừ sự kiện trùng id truyền vào
        $listEvent = Event::query()->where("event_id", "!=", $id)->get();

        // check sự kiện có tồn tại hay không
        if (empty($event[0])) {

            // nếu không tồn tại sự kiện sẽ trả về lỗi 404
            return view('error-404', compact(['errors' => "không tìm thấy event"]));
        } else {
            // dùng vòng lặp để so sánh tên của sự kiện được gừi lên có trùng với tên của sự kiện ở DB hay không
            foreach ($listEvent as $value) {
                if ($value->event_name == $request->event_name) {
                    return view('admin.events.update', compact(['data' => $event, 'errors' => "tên sự kiện bị trùng"]));
                }
            }

            // tự động tạo slug theo tên sự kiện được thay đổi
            $request['slug'] = Str::slug($request->event_name);

            // validate form
            $validator = Validator::make(
                $request->all(),
                [
                    'event_name' => 'required|min:5',
                    'date_start' => 'required',
                    'date_end' => 'required',
                    'type_event' => 'required'

                ],
                [
                    'event_name.required' => 'tên sự kiện không được để trống',
                    'date_start.required' => 'thời gian bắt đầu không được để trống',
                    'date_end.required' => 'thời gian kết thúc không được để trống',
                    'event_name.min' => 'tên sự kiện không được nhỏ hơn 5 ký tự',
                    'type_event.required' => 'kiểu sự kiện không được để trống'
                ]

            );

            // check validate fails
            if ($validator->fails()) {
                return view('admin.events.index', compact(['event' => $event, 'errors' => $validator->errors()]));
            } else {
                Event::query()->where('event_id', $id)->update($request->all());
                return view('admin.events.update', compact(
                    [
                        'event' => Event::query()->where('event_id', $id)->get(),
                        'message' => "cập nhật thành công"
                    ]
                ));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Event::query()->where('event_id', $id)->get();
            $data->delete();
            return view('admin.events.index', compact(['message' => 'xóa thành công']));
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return view('error-404', compact(['error' => 'không tìm thấy sự kiện']));
            }
        }
    }
}
