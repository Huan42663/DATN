<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Validator;
use Log;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Size::query()->orderByDesc('size_id')->get();
        return View('admin.sizes.index',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['size_name' => "required|unique:sizes,size_name"],
            [
                "size_name.required" => "Không được bỏ trống",
                "size_name.unique" => "Size đã có"
            ]
            );
            $data=['size_name'=>$request['size_name']];
            Size::create($data);
            return redirect()->back()->with("success","Thêm Size Thành Công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $size_id)
    {
            $SizeInfo = Size::query()->where("size_id", '=', $size_id)->get();
            $data = Size::query()->orderByDesc('size_id')->get();
            if ($SizeInfo) {
                return View('admin.sizes.index',compact('SizeInfo','data'));
            } else {
                return View('admin.sizes.index',compact('data'))->with('error','Không tìm thấy size');
            }
           
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $SizeInfo = Size::query()->where("size_id", '=', $size->size_id)->get();
        $data = Size::query()->orderByDesc('size_id')->get();
        $sizeCheck = Size::query()->where("size_id", '!=', $size->size_id)->get();
        foreach ($sizeCheck as $value) {
            if ($value->size_name == $request["size_name"]) {
                return View('admin.sizes.index',compact('SizeInfo','data'))->with('error','Size đã có');
            }
        }
        $request->validate(
            ['size_name' => "required"],
        [
            "size_name.required" => "Không được bỏ trống"
        ]) ;
            $data=['size_name'=>$request['size_name']];
            $size->update($data);
            return redirect()->route('Administration.sizes.list')->with('success','Sửa Size Thành Công');;
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if(isset($request->size_id) && !empty($request->size_id)){
            foreach($request->size_id as $item){
                $size =Size::query()->find($item);
                $size->delete();
            }
            return redirect()->route('Administration.sizes.list')->with('success','Xóa size thành công');
        }
        else{
            return redirect()->route('Administration.sizes.list')->with('error','Không tìm thấy size ');
        }
    }
    public function listSizeDelete(){
        $sizes = Size::onlyTrashed()->get();
        return View('admin.sizes.listDelete',compact('sizes'));
    }
    public function restoreSize(Request $request){
        if(isset($request->size_id) && !empty($request->size_id)){
            foreach($request->size_id as $item){
                $size =Size::withTrashed()->find($item);
                $size->restore();
            }
            return redirect()->route('Administration.sizes.list')->with('success','Khôi phục size thành công');
        }
        else{
            return redirect()->route('Administration.sizes.list');
        }
    }
}
