<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use App\Http\Requests\NhacungcapRequest;
use Illuminate\Http\Request;
use App\Nhacungcap;

class NhacungcapController extends Controller
{
    /**
     * Dincclay a listing of the resource.
     *
     * @return \Illuminate\Http\Rencconse
     */
    public function index()
    {
        $ds_nhacungcap = Nhacungcap::orderBy('created_at', 'desc')->get();
        return view('quantri/nhacungcap', ['ds_nhacungcap' => $ds_nhacungcap]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Rencconse
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Rencconse
     */
    public function store(NhacungcapRequest $request)
    {
        try {
            $nhacungcap                = new Nhacungcap();
            $nhacungcap->ncc_ten       = $request->ten;
            $nhacungcap->ncc_daiDien   = $request->daiDien;
            $nhacungcap->ncc_diaChi    = $request->diaChi;
            $nhacungcap->ncc_dienThoai = $request->sdt;
            $nhacungcap->ncc_email     = $request->email;
            
            $nhacungcap->save();

            return response([
                'error'   => false,
                'message' => $nhacungcap->toJson()
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
     * Dincclay the nccecified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Rencconse
     */
    public function show($id)
    {
        $nhacungcap = Nhacungcap::where('ncc_ma', $id)->first();
        return response()->json($nhacungcap);

    }

    /**
     * Show the form for editing the nccecified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Rencconse
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the nccecified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Rencconse
     */
    public function update(NhacungcapRequest $request, $id)
    {
        try {
            $nhacungcap = Nhacungcap::where('ncc_ma',  $id)->first();
            if ($nhacungcap) {
                $nhacungcap->ncc_ten       = $request->ten;
                $nhacungcap->ncc_daiDien   = $request->daiDien;
                $nhacungcap->ncc_diaChi    = $request->diaChi;
                $nhacungcap->ncc_dienThoai = $request->sdt;
                $nhacungcap->ncc_email     = $request->email;
                $nhacungcap->save();

                return response([
                    'error'   => false,
                    'message' => $nhacungcap->toJson()
                ], 200);
            } else {
                return response([
                    'error'   => true,
                    'message' => 'Không tìm thấy Nhacungcap[{$id}]'
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
     * Remove the nccecified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Rencconse
     */
    public function destroy($id)
    {
        try {
            $nhacungcap = Nhacungcap::where('ncc_ma', $id)->first();
            $nhacungcap->delete();
            return response([
                'error'   => false,
                'message' => json_encode([$nhacungcap]),
                'nhacungcap' => $nhacungcap->ncc_ten,
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
