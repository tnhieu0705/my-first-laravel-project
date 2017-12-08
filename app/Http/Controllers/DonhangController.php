<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Donhang;
use App\Chitietdonhang;
use DB;

class DonhangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_donhang = Donhang::orderBy('created_at', 'desc')->get();
        return view('quantri/donhang', ['ds_donhang' => $ds_donhang]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donhang = Donhang::where('dh_ma', $id)->first();
        $ds_sanpham = Chitietdonhang::where('dh_ma', $id)->get();
        $dh_tongTien = 0;
        foreach ($ds_sanpham as $sp) {
            $dh_tongTien = $dh_tongTien + ($sp->ctdh_soLuong * $sp->ctdh_donGia);
        }
        return view('quantri/chitiet_donhang', [
            'donhang' => $donhang,
            'ds_sanpham' => $ds_sanpham,
            'dh_tongTien' => $dh_tongTien
        ]);
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
            $donhang = Donhang::where('dh_ma',  $id)->first();
            $donhang->delete();
            return response([
                'error'   => false,
                'message' => json_encode([$donhang]),
                'donhang' => $donhang->dh_ma,
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
