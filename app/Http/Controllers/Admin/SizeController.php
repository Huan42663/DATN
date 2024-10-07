<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Log;

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $data = Size::query()->where("size_id", '=', $id)->get();
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
                    ['message' => "Không tìm thấy"],
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
                    ['message' => "Không tìm thấy"],
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
        //
    }
}
