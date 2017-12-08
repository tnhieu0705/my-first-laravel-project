<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\KhachhangRequest;
use Illuminate\Http\Request;
use App\Nhanvien;
use App\Khachhang;
use App\Donhang;

class KhachhangController extends Controller
{
    public function ktEmail($email)
    {
        $email = Nhanvien::where('nv_email', $email)->first();
        return $email != null? true : false;
    }

    public function getRegister() 
    {
        return view('dangky');
    }

    public function register(KhachhangRequest $request)
    {
        $email = $this->ktEmail($request->email);
        
        if($email === true) {
            return response([
                'error'   => true,
                'message' => 'Địa chỉ email đã được sử dụng'
            ], 200);
        } else {
            $matKhau = bcrypt($request->matKhau);

            try {
                $khachhang               = new Khachhang();
                $khachhang->kh_hoTen     = $request->hoTen;
                $khachhang->kh_gioiTinh  = $request->gioiTinh;
                $khachhang->kh_diaChi    = $request->diaChi;
                $khachhang->kh_dienThoai = $request->sdt;
                $khachhang->kh_email     = $request->email;
                $khachhang->kh_matKhau   = $matKhau;

                $khachhang->save();

                return response([
                    'error'   => false,
                    'message' => $khachhang->toJson()
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ds_khachhang = Khachhang::all();
        return view('quantri/khachhang', ['ds_khachhang' => $ds_khachhang]);
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
        $khachhang  = Khachhang::find($id);
        $ds_donhang = Donhang::where('kh_ma', $id)->get();
        
        return view('quantri/chitiet_khachhang', [
            'khachhang'  => $khachhang,
            'ds_donhang' => $ds_donhang
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
        //
    }
}