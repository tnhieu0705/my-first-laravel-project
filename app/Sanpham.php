<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sanpham extends Model
{
    protected $table        = 'sanpham';
    protected $fillable     = ['sp_ten', 'sp_giaGoc', 'sp_giaBan', 'sp_thongTin', 'sp_xuatXu', 'l_ma'];

    protected $guarded      = ['sp_ma'];
    protected $primaryKey   = 'sp_ma';

    public $timestamps = true;

    public function getCreatedAtAttribute($value) 
	{
		Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

	public function thuocLoaiSanPham() 
	{
		return $this->belongsTo('App\Loaisanpham', 'l_ma', 'l_ma');
	}
}
