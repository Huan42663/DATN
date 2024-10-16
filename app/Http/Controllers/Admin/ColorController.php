<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Validator;

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
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            ['color_name' => "required|unique:colors,color_name"],
            [
                "color_name.required" => "Không được bỏ trống",
                "color_name.unique" => "Màu đã có"
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $Size = Color::create($request->all());
            return response()->json(
                [
                    'message' => "Thêm Màu Thành Công",
                    'data' => $Size
                ],
                Response::HTTP_CREATED
            );
        }
    }
    public function show(string $color_name)
    {
        try {
            $data = Color::query()->where("color_name", '=', $color_name)->get();
            $count = Count($data);
            if ($count <= 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết màu",
                        'data' => $data
                    ]
                );
            } else {
                return response()->json(
                    ['error' => "Không tìm thấy"],
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
                    ['error' => "Không tìm thấy"],
                    Response::HTTP_NOT_FOUND
                );
            }
        }
    }
    public function update(Request $request, string $id)
    {
        $color = Color::query()->where("color_id", '=', $id)->get();
        $count = Count($color);
            if ($count <= 0) {
            return response()->json([
                'error' => 'Không tìm thấy màu',
            ], Response::HTTP_NOT_FOUND);
        } else {
            $colorCheck = Color::query()->where("color_id", '!=', $id)->get();
            foreach ($colorCheck as $value) {
                if ($value->color_name == $request->color_name) {
                    return response()->json([
                        'error' => 'Tên màu đã có',
                    ], 422);
                }
            }
            $validator = Validator::make(
                $request->all(),
                ['size_name' => "sometimes|required"],
                [
                    "size_name.required" => "Không được bỏ trống"
                ]

            );

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            } else {
                Color::query()->where("color_id", '=', $id)->update($request->all());
                $color1 = Color::query()->where("color_id", '=', $id)->get();
                return response()->json(
                    [
                        'message' => "Sửa Màu Thành Công",
                        'data' => $color1
                    ],
                    Response::HTTP_CREATED
                );
            }
        }
    }
    public function destroy(string $id)
    {
        $size = Color::query()->where('color_id', '=', $id)->delete();
        if (!$size) {
            return response()->json(
                [
                    'error' => "Không tìm thấy màu",
                ],
                Response::HTTP_NOT_FOUND
            );
        } else {
            return response()->json(
                [
                    'message' => "Xóa Màu Thành Công",
                ],
                Response::HTTP_OK
            );
        }
    }
}
