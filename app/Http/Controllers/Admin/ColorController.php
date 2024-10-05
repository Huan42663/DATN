<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    public function index()
    {
        $data = Color::query()->get();
        return response()->json(
            [
                'message' => "Danh sách màu",
                'data' => $data
            ],
            Response::HTTP_OK
        );
    }
    public function show($id)
    {
        try {
            $data = Color::query()->where("color_id", '=', $id)->get();
            $count = Count($data);
            if ($count > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết màu",
                        'data' => $data
                    ]
                );
            } else {
                return response()->json(
                    ['message' => "Không tìm thấy"],
                    Response::HTTP_NOT_FOUND
                );
            }
        } catch (\Throwable $th) {
            Log::error(__CLASS__ . "@" . __FUNCTION__, [
                'Line' => $th->getLine(),
                'message' => $th->getMessage(),
            ]);

            if ($th instanceof ModelNotFoundException) {
                return response()->json(
                    ['message' => "Không tìm thấy"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }
}
