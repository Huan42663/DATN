<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

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
        $date = new \DateTime('now');
        $date_start = $request->get('date_start');
        $date_end = $request->get('date_end');
        $validatedData = $request->validate(
            [
                'event_name' => 'required|min:5',
                'date_start' => ['required', function ($error, $date, $date_start) {
                    if ($date_start <= $date) {
                        $error('ngày bắt đầu phải lớn hơn hoặc bằng ngày hiện tại');
                    }
                }],
                'date_end' => ['required', function ($error, $date_end, $date_start) {
                    if ($date_end < $date_start) {
                        $error('ngày kết thúc phải lớn hơn ngày bắt đầu');
                    }
                }],
                'type_event' => 'required'

            ],
            [
                'event_name.required' => 'tên sự kiện không được để trống',
                'event_name.min' => 'tên sự kiện không được nhỏ hơn 5 ký tự',
                'date_start.required' => 'ngày bắt đầu không được để trống',
                'date_end.required' => 'ngày kết thúc không được để trống',
                'type_event.required' => 'kiểu sự kiện không được để trống'
            ]
        );
        $event = Event::create($validatedData);
        return response()->json(['data' => $event], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Event::find($id);
            return response()->json(
                [
                    'message' => 'chi tiết sự kiện',
                    'data' => $data
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $data = Event::find($id);
            $data->delete();
            return response()->json(
                [
                    'message' => 'Xóa sự kiện thành công.',
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
                    ['error' => "Không tìm thấy sự kiện."],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }
}
