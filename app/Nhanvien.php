<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nhanvien extends Model
{
    protected $table        = 'nhanvien';
    protected $fillable     = ['nv_hoTen', 'nv_gioiTinh', 'nv_ngaySinh', 'nv_diaChi', 'nv_dienThoai', 'nv_email', 'nv_matKhau', 'q_ma'];

    protected $guarded      = ['nv_ma'];
    protected $primaryKey   = 'nv_ma';
    protected $dates        = ['nv_ngaySinh'];

    public $timestamps      = true;

    public function getCreatedAtAttribute($value) 
	{
        Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

    public function thuocQuyen()
    {
        return $this->belongsTo('App\Quyen', 'q_ma', 'q_ma');
    }
}
