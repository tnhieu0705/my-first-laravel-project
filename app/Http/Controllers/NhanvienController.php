<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\NhanvienRequest;
use Illuminate\Http\Request;
use App\Nhanvien;
use App\Quyen;
use DB;

class NhanvienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $ds_quyen    = Quyen::all();
            $ds_nhanvien = Nhanvien::where('nv_ma', '>', '1')->get();
            // $json        = json_encode($ds_nhanvien);
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
        return view('quantri/nhanvien', [
            'ds_quyen'    => $ds_quyen,
            'ds_nhanvien' => $ds_nhanvien
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
    public function store(NhanvienRequest $request)
    {
        // $string = stripUnicode($request->hoTen);
        // $matKhau = str_shuffle(preg_replace('/\s+/', '', $string));

        $matKhau = bcrypt('12345');

        try {
            $nhanvien               = new Nhanvien();
            $nhanvien->nv_hoTen     = $request->hoTen;
            $nhanvien->nv_gioiTinh  = $request->gioiTinh;
            $nhanvien->nv_ngaySinh  = $request->ngaySinh;
            $nhanvien->nv_diaChi    = $request->diaChi;
            $nhanvien->nv_dienThoai = $request->sdt;
            $nhanvien->nv_email     = $request->email;
            $nhanvien->nv_matKhau   = $matKhau;
            $nhanvien->q_ma         = $request->maQuyen;
            
            $nhanvien->save();

            return response([
                'error'   => false,
                'message' => $nhanvien->toJson()
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
        $nhanvien = Nhanvien::where('nv_ma', $id)->first();
        return response()->json($nhanvien);
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
    public function update(NhanvienRequest $request, $id)
    {
        try {
            $nhanvien = Nhanvien::where('nv_ma',  $id)->first();
            if ($nhanvien) {
                $nhanvien->nv_hoTen     = $request->hoTen;
                $nhanvien->nv_gioiTinh  = $request->gioiTinh;
                $nhanvien->nv_ngaySinh  = $request->ngaySinh;
                $nhanvien->nv_diaChi    = $request->diaChi;
                $nhanvien->nv_dienThoai = $request->sdt;
                $nhanvien->nv_email     = $request->email;
                $nhanvien->q_ma         = $request->maQuyen;
                $nhanvien->save();

                return response([
                    'error'   => false,
                    'message' => $nhanvien->toJson()
                ], 200);
            } else {
                return response([
                    'error'   => true,
                    'message' => 'Không tìm thấy Nhanvien[{$id}]'
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $nhanvien = Nhanvien::where("nv_ma",  $id)->first();
            $nhanvien->delete();
            return response([
                'error'   => false,
                'message' => json_encode([$nhanvien]),
                'nhanvien' => $nhanvien->nv_hoTen,
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
