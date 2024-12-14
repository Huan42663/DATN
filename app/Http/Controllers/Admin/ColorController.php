<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log as FacadesLog;
use Illuminate\Support\Facades\Validator;
use Log;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Color::query()->orderByDesc('color_id')->get();
        return View('admin.colors.index', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            ['color_name' => "required|unique:colors,color_name"],
            [
                "color_name.required" => "Không được bỏ trống",
                "color_name.unique" => "Màu đã có"
            ]
        );
        $data = ['color_name' => $request['color_name']];
        $checkText = new PostController;
        $check = $checkText->ValidateText($request['color_name']);
        if($check == false){
            $_SESSION['color'] = $request['color_name'];
            return redirect()->back()->with('color','tên của màu không được chứa kí tự đặc biệt');
        }
        Color::create($data);
        unset($_SESSION['color']);
        return redirect()->back()->with("success", "Thêm màu Thành Công");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $color_id)
    {
        $ColorInfo = Color::query()->where("color_id", '=', $color_id)->get();
        $data = Color::query()->orderByDesc('color_id')->get();
        if ($ColorInfo) {
            return View('admin.colors.index', compact('ColorInfo', 'data'));
        } else {
            return View('admin.colors.index', compact('data'))->with('error', 'Không tìm thấy màu');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $ColorInfo = Color::query()->where("color_id", '=', $color->color_id)->get();
        $data = Color::query()->orderByDesc('color_id')->get();

        $ColorCheck = Color::query()->where("color_id", '!=', $color->color_id)->get();
        foreach ($ColorCheck as $value) {
            if ($value->color_name == $request["color_name"]) {
                return View('admin.colors.index', compact('ColorInfo', 'data'))->with('error', 'Màu đã có');
            }
        }
        $request->validate(
            ['color_name' => "required"],
            [
                "color_name.required" => "Không được bỏ trống"
            ]
        );
        $data = ['color_name' => $request['color_name']];
        $checkText = new PostController;
        $check = $checkText->ValidateText($request['color_name']);
        if($check == false){
            $_SESSION['color'] = $request['color_name'];
            return redirect()->back()->with('color','tên của màu không được chứa kí tự đặc biệt');
        }
        $color->update($data);
        unset($_SESSION['color']);
        return redirect()->route('Administration.colors.list')->with('success', 'Sửa Màu Thành Công');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (isset($request->color_id) && !empty($request->color_id)) {
            foreach ($request->color_id as $item) {
                $color = Color::query()->find($item);
                $data = ['quantity'=>0];
                ProductVariant::where('color_id',$item)->update($data);
                $color->delete();
            }
            return redirect()->route('Administration.colors.list')->with('success', 'Xóa màu thành công');
        } else {
            return redirect()->route('Administration.colors.list')->with('error', 'Không tìm thấy màu ');
        }
    }
    public function listColorDelete()
    {
        $color = Color::onlyTrashed()->get();
        return View('admin.colors.listDelete', compact('color'));
    }
    public function restoreColor(Request $request)
    {
        if (isset($request->color_id) && !empty($request->color_id)) {
            foreach ($request->color_id as $item) {
                $color = Color::withTrashed()->find($item);
                $color->restore();
            }
            return redirect()->route('Administration.colors.list')->with('success', 'Khôi phục màu thành công');
        } else {
            return redirect()->route('Administration.colors.list');
        }
    }
}
