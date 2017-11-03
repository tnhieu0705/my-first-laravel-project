<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\SanphamRequest;
use Illuminate\Http\Request;
use App\Loaisanpham;
use App\Sanpham;
use App\Chude;
use DB;

class SanphamController extends Controller
{
    public function getSelectData($id) 
    {
        $ds_loaisanpham = Loaisanpham::where('cd_ma', $id)->get();
        foreach($ds_loaisanpham as $loaisanpham) {
            echo '<option value="'.$loaisanpham->l_ma.'">'.$loaisanpham->l_ten.'</option>';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_chude = Chude::all();
        $ds_sanpham = Sanpham::orderBy('created_at', 'desc')->get();
        return view('quantri/sanpham', [
            'ds_chude'       => $ds_chude,
            'ds_sanpham'     => $ds_sanpham
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
    public function store(SanphamRequest $request)
    {
        try {
            $sanpham              = new Sanpham();
            $sanpham->sp_ten      = $request->ten;
            $sanpham->sp_giaGoc   = $request->giaGoc;
            $sanpham->sp_giaBan   = $request->giaBan;
            $sanpham->sp_thongTin = $request->thongTin;
            $sanpham->sp_xuatXu   = $request->xuatXu;
            $sanpham->l_ma        = $request->maLoai;
            
            $sanpham->save();

            return response([
                'error'   => false,
                'message' => $sanpham->toJson()
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sanpham = Sanpham::where('sp_ma', $id)->first();
        $chude = $sanpham->thuocLoaiSanPham->thuocChuDe->cd_ma;
        return response()->json([$sanpham, $chude]);
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
        //
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
            $sanpham = Sanpham::where('sp_ma',  $id)->first();
            $sanpham->delete();
            return response([
                'error'   => false,
                'message' => json_encode([$sanpham]),
                'sanpham' => $sanpham->sp_ten,
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
