<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Nhanvien;
use DB;

class TongquanController extends Controller
{
    public function getData() 
    {
    	$ds_nhanvien = Nhanvien::where('nv_ma', '>', '1')->get();

    	return view('quantri/tongquan', ['ds_nhanvien' => $ds_nhanvien]);
    }
}
