<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loaisanpham extends Model
{
    protected $table        = 'loaisanpham';
    protected $fillable     = ['l_ten', 'l_dienGiai', 'l_trangThai', 'cd_ma'];

    protected $guarded      = ['l_ma'];
    protected $primaryKey   = 'l_ma';

    public $timestamps = true;

    public function getCreatedAtAttribute($value) 
	{
		Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

	public function thuocChuDe() 
	{
		return $this->belongsTo('App\Chude', 'cd_ma', 'cd_ma');
	}

	public function coSanPham()
	{
		return $this->hasMany('App\Sanpham', 'l_ma', 'l_ma');
	}
}
