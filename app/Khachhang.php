<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Khachhang extends Model
{
    protected $table        = 'khachhang';
    protected $fillable     = ['kh_hoTen', 'kh_gioiTinh', 'kh_diaChi', 'kh_dienThoai', 'kh_email', 'kh_matKhau'];

    protected $guarded      = ['kh_ma'];
    protected $primaryKey   = 'kh_ma';
    // protected $dates        = ['kh_ngaySinh'];

    public $timestamps = true;

    public function getCreatedAtAttribute($value) 
	{
        Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

    public function coDonHang()
    {
        return $this->hasMany('App\Donhang', 'kh_ma', 'kh_ma');
    }
}
