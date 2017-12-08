<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdonhang extends Model
{
    protected $table        = 'chitiet_donhang';
    protected $fillable     = ['ctdh_soLuong', 'ctdh_donGia'];
    protected $guarded      = ['dh_ma', 'sp_ma'];

    protected $primaryKey   = ['dh_ma', 'sp_ma'];
    public $timestamps   	= false;
    public $incrementing 	= false;

    public function thuocSanPham() 
    {
    	return $this->belongsTo('App\Sanpham', 'sp_ma', 'sp_ma');
    }
}
