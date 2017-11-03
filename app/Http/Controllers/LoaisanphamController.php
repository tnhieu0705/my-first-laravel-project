<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Chude;
use Validator;
use DB;

class LoaisanphamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_chude = Chude::all();
        $ds_loaisanpham = Loaisanpham::orderBy('created_at', 'desc')->get();
        return view('quantri/loaisanpham', [
            'ds_loaisanpham' => $ds_loaisanpham, 
            'ds_chude'       => $ds_chude
        ]);
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
            'ten'      => 'required|unique:loaisanpham,l_ten|min:2|max:50',
            'dienGiai' => 'nullable|min:2|max:150'
        ];
        $messages = [
            'ten.required' => 'Vui lòng nhập tên loại sản phẩm',
            'ten.unique'   => 'Tên loại sản phẩm đã tồn tại',
            'ten.min'      => 'Tên loại sản phẩm tối thiểu 2 ký tự',
            'ten.max'      => 'Tên loại sản phẩm tối đa 50 ký tự',
            'dienGiai.min' => 'Diễn giải loại sản phẩm tối thiểu 2 ký tự',
            'dienGiai.max' => 'Diễn giải loại sản phẩm tối đa 150 ký tự'
        ];

        $val = Validator::make($request->all(), $rules, $messages);
        if($val->fails()) {
            return response()->json([
                'error'   => true,
                'message' => $val->errors()
            ], 200);
        } else {
            try {
                $loaisanpham             = new Loaisanpham();
                $loaisanpham->l_ten      = $request->ten;
                $loaisanpham->l_dienGiai = $request->dienGiai;
                $loaisanpham->cd_ma      = $request->chuDe;

                $loaisanpham->save();

                return response([
                    'error'   => false,
                    'message' => $loaisanpham->toJson()
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
        $loaisanpham = Loaisanpham::where('l_ma', $id)->first();
        return response()->json($loaisanpham);
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
            'ten'      => 'required|unique:loaisanpham,l_ten,'.$id.',l_ma|min:2|max:50',
            'dienGiai' => 'nullable|min:2|max:150'
        ];
        $messages = [
            'ten.required' => 'Vui lòng nhập tên loại sản phẩm',
            'ten.unique'   => 'Tên loại sản phẩm đã tồn tại',
            'ten.min'      => 'Tên loại sản phẩm tối thiểu 2 ký tự',
            'ten.max'      => 'Tên loại sản phẩm tối đa 50 ký tự',
            'dienGiai.min' => 'Diễn giải loại sản phẩm tối thiểu 2 ký tự',
            'dienGiai.max' => 'Diễn giải loại sản phẩm tối đa 150 ký tự'
        ];

        $val = Validator::make($request->all(), $rules, $messages);
        if($val->fails()) {
            return response()->json([
                'error'   => true,
                'message' => $val->errors()
            ], 200);
        } else {
            try {
                $loaisanpham = Loaisanpham::where('l_ma',  $id)->first();
                if ($loaisanpham) {
                    $loaisanpham->l_ten       = $request->ten;
                    $loaisanpham->l_dienGiai  = $request->dienGiai;
                    $loaisanpham->cd_ma       = $request->chuDe;

                    $loaisanpham->save();

                    return response([
                        'error'   => false,
                        'message' => $loaisanpham->toJson()
                    ], 200);
                } else {
                    return response([
                        'error'   => true,
                        'message' => 'Không tìm thấy Loaisanpham[{$id}]'
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
            $loaisanpham = Loaisanpham::where('l_ma', $id)->first();
            if(count($loaisanpham->coSanPham) > 0) {
                return response([
                    'error'       => true,
                    'message'     => '<b>'.'Thao tác thất bại!'.'</b>'.'<br>'.'Vui lòng xóa <b>sản phẩm</b> thuộc loại <b>'.$loaisanpham->l_ten.'</b> trước'
                ], 200);
            } else {
                $loaisanpham->delete();
                return response([
                    'error'       => false,
                    'message'     => json_encode([$loaisanpham]),
                    'loaisanpham' => $loaisanpham->l_ten,
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
