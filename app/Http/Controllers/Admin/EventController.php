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
        return response()->json(
            [
                'message' => 'danh sách sự kiện',
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
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        } else {
            $event = Event::create($request->all());
            return response()->json(['data' => $event], Response::HTTP_CREATED);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        try {
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
            return response()->json(
                [
                    'message' => 'chi tiết sự kiện',
                    'event' => $event,
                    'products' => $products
                ]
            );
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['message' => "Không tìm thấy sự kiện"],
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
        // lấy ra sự kiện theo id
        $event = Event::query()->where('event_id', $id)->get();

        // lấy ra list sự kiện trừ sự kiện trùng id truyền vào
        $listEvent = Event::query()->where("event_id", "!=", $id)->get();

        // check sự kiện có tồn tại hay không
        if (empty($event[0])) {

            // nếu không tồn tại sự kiện sẽ trả về lỗi 404
            return response()->json(['errors' => "không tìm thấy event"], Response::HTTP_NOT_FOUND);
        } else {

            // dùng vòng lặp để so sánh tên của sự kiện được gừi lên có trùng với tên của sự kiện ở DB hay không
            foreach ($listEvent as $value) {
                if ($value->event_name == $request->event_name) {

                    // nếu trùng trả về lỗi
                    return response()->json(['errors' => "tên sự kiện bị trùng"], Response::HTTP_BAD_REQUEST);
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
                return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
            } else {
                Event::query()->where('event_id', $id)->update($request->all());
                return response()->json([
                    'data' => Event::query()->where('event_id', $id)->get()
                ], Response::HTTP_OK);
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
            return response()->json(
                [
                    'message' => 'Xóa sự kiện thành công',
                    Response::HTTP_OK
                ]
            );
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['message' => "Không tìm thấy sự kiện"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }
}
