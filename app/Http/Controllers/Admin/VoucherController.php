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
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Log;
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
        foreach ($data as $key) {
            if ($key->type == 1) {
                $key->type = "Giảm theo %";
            } else {
                $key->type = "Giảm theo giá tiền";
            }
        };
        return View('admin.vouchers.index',compact('data'));
    }
    public function create()
    {
        return View('admin.vouchers.create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "voucher_code" => "required|unique:vouchers,voucher_code|regex:/^[a-zA-Z0-9\s]+$/",
                "type"         => "required|integer",
                "value"        => "required|integer|min:1",
                "quantity"     => "required|integer|min:1",
                "date_start"   => "required|date",
                "date_end"     => "required|date",
            ],
            [
                "voucher_code.required"         => "Không được bỏ trống mã giảm giá",
                "voucher_code.regex"            => "Mã voucher không được chứa kí tự đặc biệt",
                "voucher_code.unique"           => "Đã có mã giảm giá này",
                "type.required"                 => "Không được bỏ trống loại giảm giá",
                "type.integer"                  => "Loại giảm giá của voucher không hợp lệ",
                "value.required"                => "Không được bỏ trống giá trị của mã giảm giá",
                "value.integer"                 => "Giá trị của voucher phải là số nguyên",
                "value.min"                     => "Giá trị của voucher phải là lớn hơn 0",
                "quantity.min"                  => "Số lượng voucher phải là lớn hơn 0",
                "quantity.required"             => "Không được bỏ trống số lượng",
                "quantity.integer"              => "Số lượng voucher phải là số nguyên",
                "date_start.required"           => "Vui Lòng nhập thời gian bắt đầu của mã giảm giá",
                "date_start.date"               => "Thời gian bắt đầu của mã giảm giá không hợp lệ",
                "date_end.required"             => "Vui Lòng nhập thời gian kết thúc của mã giảm giá",
                "date_end.date"                 => "Thời gian kết thúc của mã giảm giá không hợp lệ",

            ]
        );
        $datetime = new DateTime($request['date_start']);
        $datetime1 = new DateTime($request['date_end']);
        $formattedDateTime = $datetime->format('Y-m-d H:i:s');
        $formattedDateTime1 = $datetime1->format('Y-m-d H:i:s');
        $request['date_start'] = $formattedDateTime;
        $request['date_end'] = $formattedDateTime1;
        // dd(Carbon::now());
        if ($request['date_start'] < Carbon::now()) {
            $data = $request->all();
            $data1 = "Thời gian bắt đầu phải bằng hoặc lớn hơn thời gian hiện tại";
            return  View('admin.vouchers.create',compact('data','data1'));
        }
        if ($request['date_end'] <= $request['date_start']) {
            $data = $request->all();
            $data2 = "Thời gian kết thúc phải lớn hơn thời gian bắt đầu và ngày hiện tại";
            return  View('admin.vouchers.create',compact('data','data2'));
        }

        if ($request['type'] == 0 && $request["value"] > 100) {
            $data = $request->all();
            $data3 = "Kiểu giảm giá theo % chỉ tối đa là 100";
            return View('admin.vouchers.create',compact('data','data3'));
        }
        $data4 = [
            "voucher_code" => $request['voucher_code'],
            "type"         => $request['type'],
            "value"        => $request['value'],
            "quantity"     => $request['quantity'],
            "date_start"   => $request['date_start'],
            "date_end"     => $request['date_end'],
        ];

            $voucher = Voucher::create($data4);
            return redirect()->back()->with("success","Thêm Mã Khuyến Mãi Thành Công");;
           
        }

    /**
     * Display the specified resource.
     */
    public function show(string $voucher_code)
    {
            $data = Voucher::query()->where("voucher_code", '=', $voucher_code)->get();
            $count = Count($data);
            if ($count > 0) {
                return View('admin.vouchers.update',compact('data'));
            } else {
                return redirect()->route('Administration.vouchers.list')->with("error","Không tìm thấy mã khuyến mãi");
            }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Voucher $voucher)
    {
        $voucher1 = Voucher::query()->where("voucher_id", $voucher->voucher_id)->get();
        $voucherCheck = Voucher::query()->where("voucher_id", '!=', $voucher1[0]->voucher_id)->get();
        $request->validate(
            [
                "voucher_code" => "required|regex:/^[a-zA-Z0-9\s]+$/",
                "type"         => "required|integer",
                "value"        => "required|integer|min:1",
                "quantity"     => "required|integer|min:1",
                "date_start"   => "required|date",
                "date_end"     => "required|date",
            ],
            [
                "voucher_code.required"         => "Không được bỏ trống mã giảm giá",
                "voucher_code.regex"            => "Mã voucher không được chứa kí tự đặc biệt",
                "type.required"                 => "Không được bỏ trống loại giảm giá",
                "type.integer"                  => "Loại giảm giá của voucher không hợp lệ",
                "value.required"                => "Không được bỏ trống giá trị của mã giảm giá",
                "value.integer"                 => "Giá trị của voucher phải là số nguyên",
                "value.min"                     => "Giá trị của voucher phải là lớn hơn 0",
                "quantity.min"                  => "Số lượng voucher phải là lớn hơn 0",
                "quantity.required"             => "Không được bỏ trống số lượng",
                "quantity.integer"              => "Số lượng voucher phải là số nguyên",
                "date_start.required"           => "Vui Lòng nhập thời gian bắt đầu của mã giảm giá",
                "date_start.date"               => "Thời gian bắt đầu của mã giảm giá không hợp lệ",
                "date_end.required"             => "Vui Lòng nhập thời gian kết thúc của mã giảm giá",
                "date_end.date"                 => "Thời gian kết thúc của mã giảm giá không hợp lệ",

            ]
        );
            foreach ($voucherCheck as $value) {
                if ($value->voucher_code === $request->voucher_code) {
                    return redirect()->back()->with("error","Mã khuyến mãi đã có");
                }
            }
            if ($request['date_end'] <= Carbon::now()) {
                return redirect()->back()->with("error1","Ngày kết thúc phải lớn hơn ngày hiện tại");
            }

            if ($request['type'] == 0 && $request["value"] > 100) {
                return redirect()->back()->with("error2","Mức giảm tối đa cho phần trăm là 100");
            }

                $voucher->update($request->all());
                return redirect()->route('Administration.vouchers.show',$request->voucher_code)->with("success","Sửa mã khuyến mãi thành công");
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(isset($request->voucher_id) && !empty($request->voucher_id)){
            foreach($request->voucher_id as $item){
                Voucher::query()->where('voucher_code',$item)->delete();
            }
            return redirect()->back()->with('success','Xóa mã khuyến mãi thành công');
        }
        else{
            return redirect()->back()->with('error','Không tìm thấy mã khuyến mãi ');
        }
    }
}
