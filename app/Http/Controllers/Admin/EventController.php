<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\ProductEvent;
use App\Models\Products;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class EventController extends Controller
{

    public function __construct()
    {
        
        $date = Carbon::now();
        $Event = Event::query()->get();
        $data1['status'] = 0;
            foreach ($Event as $key) {
                if($key->status != 0){
                    if ($key->date_end == $date || $key->date_end < $date) {
                        Event::query()->where('event_id', $key->event_id)->update($data1);
                    }
                }
            }

        unset($_SESSION['thankyou']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::query()->orderByDesc('event_id')->get();
        return view('admin.events.index', compact('events'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function create()
    {
        $products = Products::all();
        return view('admin.events.create', compact('products'));
    }
    public function store(Request $request)
    {

        // tự động tạo slug theo tên sự kiện
        $request['slug'] = Str::slug($request->event_name);

        // validate form
        $request->validate(
            [
                'event_name' => 'required|min:5|unique:events,event_name',
                'date_start' => 'required|date|after:today',
                'date_end' => 'required|date|after:date_start',
                'discount' => 'nullable|integer',
                'type_event' => 'required'

            ],
            [
                'event_name.required' => 'tên sự kiện không được để trống',
                'event_name.unique' => 'tên sự kiện đã bị trùng',
                'discount.integer' => 'giảm giá phải là số',
                'date_start.required' => 'thời gian bắt đầu không được để trống',
                'date_start.after' => 'thời gian bắt đầu không phù hợp',
                'date_start.date' => 'thời gian bắt đầu không phù hợp',
                'date_end.date' => 'thời gian kết thúc không phù hợp',
                'date_end.after' => 'thời gian kết thúc không phù hợp',
                'date_end.required' => 'thời gian kết thúc không được để trống',
                'event_name.min' => 'tên sự kiện không được nhỏ hơn 5 ký tự',
                'type_event.required' => 'kiểu sự kiện không được để trống'
            ]
        );

        $data = $request->except('_token', '_method', 'example_length', 'products');
        $event = Event::query()->create($data);
        // dd($event->id);

        if (!empty($request->products)) {
            foreach ($request->products as $value) {
                ProductEvent::create(['event_id' => $event->id, 'product_id' => $value]);
            }
        }
        return redirect()->route('Administration.events.list')->with('success', 'thêm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function edit(string $id)
    {
        $event = Event::where('event_id', $id)->first();
        $products = Products::all();
        $product_event = ProductEvent::where('event_id', $id)->get();
        return view('admin.events.update', compact('event', 'products', 'product_event'));
    }
    public function show(string $slug)
    {

        // lấy ra sự kiện theo slug
        $event = Event::query()
            ->where('slug', '=', $slug)
            ->select(
                'event_name',
                'date_start',
                'date_end',
                'type_event',
                'discount',
                'status',
                'event_id',
                'slug'
            )
            ->first();
        // lấy ra mảng sản phẩm của sự kiện
        $product_event = ProductEvent::query()
            ->where('slug', $slug)
            ->join('events', 'product_event.event_id', '=', 'events.event_id')
            ->join('products', 'products.product_id', '=', 'product_event.product_id')
            ->select(
                'products.product_id',
                'product_name',
                'product_image'
            )
            ->get();
        $products = Products::all();
        return view('admin.events.show', compact('event', 'products', 'product_event'));
    }
    public function remove(Request $request, string $slug)
    {
        if ($request->products) {
            foreach ($request->products as $product) {
                ProductEvent::where('product_id', '=', $product, 'AND', 'events.slug', '=', $slug)
                    ->join('events', 'events.event_id', '=', 'product_event.event_id')
                    ->delete();
            }
        }
        return redirect()->back();
    }
    public function add(Request $request, string $slug)
    {
        $event = Event::where('slug', $slug)->first();
        if ($request->products) {
            foreach ($request->products as $product) {
                ProductEvent::create(['event_id' => $event->event_id, 'product_id' => $product]);
            }
        }
        return redirect()->back();
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // dd($request);
        // lấy ra sự kiện theo id
        $event = Event::query()->where('event_id', $id)->get();

        // lấy ra list sự kiện trừ sự kiện trùng id truyền vào
        $listEvent = Event::query()->where("event_id", "!=", $id)->get();

        // check sự kiện có tồn tại hay không
        if (empty($event[0])) {

            // nếu không tồn tại sự kiện sẽ trả về lỗi 404
            return view('error-404')->with('error', "không tìm thấy event");
        } else {
            // dùng vòng lặp để so sánh tên của sự kiện được gừi lên có trùng với tên của sự kiện ở DB hay không
            foreach ($listEvent as $value) {
                if ($value->event_name == $request->event_name) {
                    return view('admin.events.list')->with('error', "Tên sự kiện bị trùng");
                }
            }

            // tự động tạo slug theo tên sự kiện
            $request['slug'] = Str::slug($request->event_name);

            // validate form
            $request->validate(
                [
                    'event_name' => 'required|min:5',
                    'date_start' => 'required|date|before:date_end',
                    'date_end' => 'required|date|after:date_start',
                    'discount' => 'nullable|integer',
                    'type_event' => 'required'

                ],
                [
                    'event_name.required' => 'tên sự kiện không được để trống',
                    'discount.integer' => 'giảm giá phải là số',
                    'date_start.required' => 'thời gian bắt đầu không được để trống',
                    'date_start.after' => 'thời gian bắt đầu không phù hợp',
                    'date_start.date' => 'thời gian bắt đầu không phù hợp',
                    'date_end.date' => 'thời gian kết thúc không phù hợp',
                    'date_end.after' => 'thời gian kết thúc không phù hợp',
                    'date_end.required' => 'thời gian kết thúc không được để trống',
                    'event_name.min' => 'tên sự kiện không được nhỏ hơn 5 ký tự',
                    'type_event.required' => 'kiểu sự kiện không được để trống'
                ]
            );

            $data = $request->except('_token', '_method', 'example_length', 'products');
            Event::query()->where('event_id', $id)->update($data);

            if (!empty($request->products)) {
                $check = ProductEvent::where('event_id', $id)->get();
                foreach ($check as $item) {
                    ProductEvent::where('event_id', $item->event_id)->delete();
                }
                foreach ($request->products as $value) {
                    ProductEvent::create(['event_id' => $id, 'product_id' => $value]);
                }
            }
            return redirect()->route('Administration.events.list')->with('success', 'cập nhật thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Event::query()->where('event_id', $id)->delete();;

        return redirect()->back()->with('success', 'xóa thành công');
    }
    public function listEventDelete()
    {
        $events = Event::onlyTrashed()->get();
        return View('admin.events.listDelete', compact('events'));
    }
    public function restoreEvent(Request $request)
    {
        if (isset($request->event_id) && !empty($request->event_id)) {
            $event = Event::withTrashed()->where('event_id', $request->event_id);
            $event->restore();
            return redirect()->route('Administration.events.list')->with('success', 'Khôi phục sự kiện thành công');
        } else {
            return redirect()->route('Administration.events.list');
        }
    }
}
