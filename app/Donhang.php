<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhang extends Model
{
    protected $table        = 'donhang';
    protected $fillable     = ['kh_ma', 'dh_thoiGianDatHang', 'dh_thoiGianNhanHang', 'dh_diaChi', 'dh_dienThoai', 'nv_xuLy', 'dh_trangThai'];

    protected $guarded      = ['dh_ma'];
    protected $primaryKey   = 'dh_ma';
    protected $dates 		= ['dh_thoiGianDatHang', 'dh_thoiGianNhanHang'];

    public $timestamps 		= true;
    
    public function thuocKhachHang() 
    {
    	return $this->belongsTo('App\KhachHang', 'kh_ma', 'kh_ma');
    }

    public function chiTiet()
    {
        return $this->hasMany('App\Chitietdonhang', 'dh_ma', 'dh_ma');
    }

    public function nhanVienXuLy($id)
    {
    	$nhanvien = Nhanvien::where('nv_ma', $id)->first();
    	return $nhanvien->nv_hoTen;
    }

    public function giaTriDonHang($id)
    {
        $ds_ctdh     = Chitietdonhang::where('dh_ma', $id)->get();
        $tongTien = 0;
        foreach ($ds_ctdh as $ctdh) {
            $tongTien = $tongTien + ($ctdh->ctdh_soLuong * $ctdh->ctdh_donGia);
        }
        return $tongTien;
    }
}
