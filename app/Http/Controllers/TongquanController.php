<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhanvien;
use App\Sanpham;
use App\Donhang;
use DB;

class TongquanController extends Controller
{
    public function getData() 
    {
    	$ds_nhanvien = Nhanvien::where('nv_ma', '>', '1')->get();
    	$ds_sanpham = Sanpham::all();
    	$ds_donhang = Donhang::all();

    	return view('quantri/tongquan', [
    		'ds_nhanvien' => $ds_nhanvien,
    		'ds_sanpham'  => $ds_sanpham,
    		'ds_donhang'  => $ds_donhang
    	]);
    }
}
