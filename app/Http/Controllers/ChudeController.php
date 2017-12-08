<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Chude;
use Validator;
use DB;

class ChudeController extends Controller
{

    public function getList($id)
    {
        $chude = Chude::find($id);
        $ds_loaisanpham = Loaisanpham::where('cd_ma', $id)->orderBy('created_at', 'desc')->get();
        return view('quantri/chude_loaisanpham', ['chude' => $chude, 'ds_loaisanpham' => $ds_loaisanpham]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_chude = Chude::all();
        return view('quantri/chude', ['ds_chude' => $ds_chude]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'ten'      => 'required|unique:chude,cd_ten|min:2|max:50',
            'dienGiai' => 'nullable|min:2|max:150'
        ];
        $messages = [
            'ten.required'      => 'Vui lòng nhập tên chủ đề',
            'ten.unique'        => 'Tên chủ đề đã tồn tại',
            'ten.min'           => 'Tên chủ đề tối thiểu 2 ký tự',
            'ten.max'           => 'Tên chủ đề tối đa 50 ký tự',
            'dienGiai.min'      => 'Diễn giải chủ đề tối thiểu 2 ký tự',
            'dienGiai.max'      => 'Diễn giải chủ đề tối đa 150 ký tự'
        ];

        $val = Validator::make($request->all(), $rules, $messages);
        if($val->fails()) {
            return response()->json([
                'error'   => true,
                'message' => $val->errors()
            ], 200);
        } else {
            try {
                $chude               = new Chude();
                $chude->cd_ten       = $request->ten;
                $chude->cd_dienGiai  = $request->dienGiai;

                $chude->save();

                return response([
                    'error'   => false,
                    'message' => $chude->toJson()
                ], 200);
            } catch(QueryException $ex) {
                return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
            } catch (PDOException  $ex) {
                return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
            }
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chude = Chude::where('cd_ma', $id)->first();
        return response()->json($chude);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'ten'      => 'required|unique:chude,cd_ten,'.$id.',cd_ma|min:2|max:50',
            'dienGiai' => 'nullable|min:2|max:150'
        ];
        $messages = [
            'ten.required'      => 'Vui lòng nhập tên chủ đề',
            'ten.unique'        => 'Tên chủ đề đã tồn tại',
            'ten.min'           => 'Tên chủ đề tối thiểu 2 ký tự',
            'ten.max'           => 'Tên chủ đề tối đa 50 ký tự',
            'dienGiai.min'      => 'Diễn giải chủ đề tối thiểu 2 ký tự',
            'dienGiai.max'      => 'Diễn giải chủ đề tối đa 150 ký tự'
        ];

        $val = Validator::make($request->all(), $rules, $messages);
        if($val->fails()) {
            return response()->json([
                'error'   => true,
                'message' => $val->errors()
            ], 200);
        } else {
            try {
                $chude = Chude::where('cd_ma',  $id)->first();
                if ($chude) {
                    $chude->cd_ten       = $request->ten;
                    $chude->cd_dienGiai  = $request->dienGiai;

                    $chude->save();

                    return response([
                        'error'   => false,
                        'message' => $chude->toJson()
                    ], 200);
                } else {
                    return response([
                        'error'   => true,
                        'message' => 'Không tìm thấy Chude[{$id}]'
                    ], 200);
                }
            } catch(QueryException $ex) {
                return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
            } catch (PDOException  $ex) {
                return response([
                    'error'   => true,
                    'message' => $ex->getMessage()
                ], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $chude = Chude::where('cd_ma',  $id)->first();
            if(count($chude->coLoaiSanPham) > 0) {
                return response([
                    'error'       => true,
                    'message'     => '<b>'.'Thao tác thất bại!'.'</b>'.'<br>'.'Vui lòng xóa <b>loại sản phẩm</b> thuộc chủ đề <b>'.$chude->cd_ten.'</b> trước'
                ], 200);
            } else {
                $chude->delete();
                return response([
                    'error'   => false,
                    'message' => json_encode([$chude]),
                    'chude'   => $chude->cd_ten,
                ], 200);
            }
        } catch(QueryException $ex) {
            return response([
                'error'   => true,
                'message' => $ex->getMessage()
            ], 200);
        } catch (PDOException  $ex) {
            return response([
                'error'   => true,
                'message' => $ex->getMessage()
            ], 200);
        }
    }
}
