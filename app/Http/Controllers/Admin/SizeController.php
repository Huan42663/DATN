<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;
use Validator;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Size::query()->get();
        return response()->json(
            [
                'message' => "Danh sách size",
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
        $validator = Validator::make(
            $request->all(),
            ['size_name' => "required|unique:sizes,size_name"],
            [
                "size_name.required" => "Không được bỏ trống",
                "size_name.unique" => "Size đã có"
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $Size = Size::create($request->all());
            return response()->json(
                [
                    'message' => "Thêm Size Thành Công",
                    'data' => $Size
                ],
                Response::HTTP_CREATED
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $size_name)
    {
        try {
            $data = Size::query()->where("size_name", '=', $size_name)->get();
            $count = Count($data);
            if ($count > 0) {
                return response()->json(
                    [
                        'message' => "Chi tiết size",
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
            FacadesLog::error(__CLASS__ . "@" . __FUNCTION__, [
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
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $size = Size::query()->where("size_id", '=', $id)->get();
        $count = Count($size);
        if ($count <= 0) {
            return response()->json([
                'error' => 'Không tìm thấy size',
            ], Response::HTTP_NOT_FOUND);
        } else {
            $sizeCheck = Size::query()->where("size_id", '!=', $id)->get();
            foreach ($sizeCheck as $value) {
                if ($value->size_name == $request["size_name"]) {
                    return response()->json([
                        'error' => 'Tên size đã có',
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
                $Size = Size::query()->where("size_id", '=', $id)->update($request->all());
                $size1 = Size::query()->where("size_id", '=', $id)->get();
                return response()->json(
                    [
                        'message' => "Sửa Size Thành Công",
                        'data' => $size1
                    ],
                    Response::HTTP_OK
                );
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $size = Size::query()->where('size_id', '=', $id)->delete();
        if (!$size) {
            return response()->json(
                [
                    'error' => "Không tìm thấy size",
                ],
                Response::HTTP_NOT_FOUND
            );
        } else {
            return response()->json(
                [
                    'message' => "Xóa Size Thành Công",
                ],
                Response::HTTP_OK
            );
        }
    }

    
}
