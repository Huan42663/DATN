<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use App\Events\VoucherCreated;
use App\Events\VoucherEvent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Voucher::query()->orderByDesc("voucher_id")->get();
        foreach( $data as $key ){
            if( $key->type == 1){
                $key->type = "Giảm theo %";
            }else{
                $key->type = "Giảm theo giá tiền";
            }
        }
        return response()->json(
            ["message"=>"Danh Sách Voucher",
                    "Data" =>$data            
        ],
            Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request['date_start'] < Carbon::now()){
            return response()->json([
                'error' => 'Thời Gian bắt đầu phải lớn hơn hoặc bằng thời gian hiện tại ',
                'data'  => $request->all() 
            ], 422);
        }
        if($request['date_end'] < $request['date_start'] ){
            return response()->json([
                'error' => 'Thời Gian kết thúc phải lớn hơn hoặc bằng thời gian bắt đầu ',
                'data'  => $request->all()  
            ], 422);
        }
        

        $validator = Validator::make(
            $request->all(),
            [
                "voucher_code" => "required|unique:vouchers,voucher_code",
                "type"         => "required|integer",
                "value"        => "required|integer|min:1",
                "quantity"     => "required|integer",
                "date_start"   => "required|date",
                "date_end"     => "required|date",
            ],
            [
                "voucher_code.required"         => "Không được bỏ trống mã giảm giá",
                "voucher_code.unique"           => "Đã có mã giảm giá này",
                "type.required"                 =>"Không được bỏ trống loại giảm giá",
                "type.integer"                  =>"Loại giảm giá của voucher không hợp lệ",
                "value.required"                => "Không được bỏ trông giá trị của mã giảm giá",
                "value.integer"                 =>"Giá trị của voucher phải là số nguyên",
                "value.min"                     =>"Giá trị của voucher phải là lớn hơn 0",
                "quantity.required"             => "Không được bỏ trông giá trị của mã giảm giá",
                "quantity.integer"              =>"Giá trị của voucher phải là số nguyên",
                "date_start.required"           =>"Vui Lòng nhập thời gian bắt đầu của mã giảm giá",
                "date_start.date"               =>"Thời gian bắt đầu của mã giảm giá không hợp lệ", 
                "date_end.required"             =>"Vui Lòng nhập thời gian kết thúc của mã giảm giá",
                "date_end.date"                 =>"Thời gian kết thúc của mã giảm giá không hợp lệ", 
               
            ]
        );
        if($request['type'] == 1 && $request["value"] > 100 ){
            return response()->json([
                'error' => 'giá trị theo giảm giá theo % phải nhỏ hơn 100',
                'data'  => $request->all() 
            ], 422);
        }
        $data = [
                "voucher_code" => $request['voucher_code'],
                "type"         => $request['type'],
                "value"        => $request['value'],
                "quantity"     => $request['quantity'],
                "date_start"   => $request['date_start'],
                "date_end"     => $request['date_end'],
        ];  

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        } else {
            $voucher = Voucher::create($data);
            // broadcast(new VoucherEvent($voucher));
            return response()->json(
                [
                    'message' => "Thêm Voucher Thành Công",
                    'data' => $voucher
                ],
                Response::HTTP_CREATED
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $voucher_code)
    {

        try {
            $data = Voucher::query()->where("voucher_code", '=', $voucher_code)->get();
            $count = Count($data);
            if ($count > 0) {
                if( $data[0]->type == 1){
                    $data[0]->type = "Giảm theo %";
                }else{
                    $data[0]->type = "Giảm theo giá tiền";
    
                }
                return response()->json(
                    [
                        'message' => "Chi tiết voucher",
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $voucher_code)
    {
        $voucher = Voucher::query()->where("voucher_code", '=', $voucher_code)->get();
        $count = Count($voucher);
            if ($count <= 0) {
            return response()->json([
                'error' => 'Không tìm thấy voucher',
            ], Response::HTTP_NOT_FOUND);
        } else {
            $voucherCheck = Voucher::query()->where("voucher_code", '!=', $voucher_code)->get();
            foreach ($voucherCheck as $value) {
                if ($value->voucher_code == $request->voucher_code) {
                    return response()->json([
                        'error' => 'Mã giảm giá đã có',
                        'data'  => $voucher 
                    ], 422);
                }
            }
            if($request['date_start'] < Carbon::now()){
                return response()->json([
                    'error' => 'Thời Gian bắt đầu phải lớn hơn hoặc bằng thời gian hiện tại ',
                    'data'  => $voucher 
                ], 422);
            }
            if($request['date_end'] < $request['date_start'] ){
                return response()->json([
                    'error' => 'Thời Gian kết thúc phải lớn hơn hoặc bằng thời gian bắt đầu ',
                    'data'  => $voucher 
                ], 422);
            }


            $validator = Validator::make(
                $request->all(),
                [
                    "voucher_code" => "required",
                    "type"         => "required|integer",
                    "value"        => "required|integer",
                    "quantity"     => "required|integer",
                    "date_start"   => "required|date",
                    "date_end"     => "required|date",
                ],
                [
                    "voucher_code.required"         => "Không được bỏ trống mã giảm giá",
                    "type.required"                 =>"Không được bỏ trống loại giảm giá",
                    "type.integer"                  => "loại mã giảm giá không hợp lệ",
                    "value.required"                => "Không được bỏ trông giá trị của mã giảm giá",
                    "value.integer"                 =>"Giá trị của voucher phải là số nguyên",
                    "quantity.required"             => "Không được bỏ trông giá trị của mã giảm giá",
                    "quantity.integer"              =>"Giá trị của voucher phải là số nguyên",
                    "date_start.required"           =>"Vui Lòng nhập thời gian bắt đầu của mã giảm giá",
                    "date_start.date"               =>"Thời gian bắt đầu của mã giảm giá không hợp lệ",
                    "date_end.required"             =>"Vui Lòng nhập thời gian kết thúc của mã giảm giá",
                    "date_end.date"                 =>"Thời gian kết thúc của mã giảm giá không hợp lệ", 
                     
                ]
            );

            if($request['type'] == 1 && $request["value"] > 100 ){
                return response()->json([
                    'error' => 'giá trị theo giảm giá theo % phải nhỏ hơn 100',
                    'data'  => $request->all() 
                ], 422);
            }
            
            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                    'data'    =>$voucher
                ], 422);
            } else {
                Voucher::query()->where("voucher_code", '=', $voucher_code)->update($request->all());
                $color1 = Voucher::query()->where("voucher_code", '=', $voucher_code)->get();
                return response()->json(
                    [
                        'message' => "Sửa Màu Thành Công",
                        'data' => $color1
                    ],
                    Response::HTTP_OK
                );
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $voucher_code)
    {
        $voucher = Voucher::query()->where("voucher_code", '=', $voucher_code)->get();
        $count = Count($voucher);
        if ($count <= 0) {
            return response()->json([
                'error' => 'Không tìm thấy voucher',
            ], Response::HTTP_NOT_FOUND);
        } else {
            $voucher = Voucher::query()->where("voucher_code", '=', $voucher_code)->delete();
            return response()->json(
                [
                    'message' => "Xóa Voucher Thành Công",
                ],
                Response::HTTP_OK
            );
        }
    }
}
