<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Nhacungcap extends Model
{
    protected $table        = 'nhacungcap';
    protected $fillable     = ['ncc_ten', 'ncc_daiDien', 'ncc_diaChi', 'ncc_dienThoai', 'ncc_email', 'ncc_trangThai'];

    protected $guarded      = ['ncc_ma'];
    protected $primaryKey   = 'ncc_ma';

    public $timestamps = true;

    public function getCreatedAtAttribute($value) 
	{
		Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}
}
