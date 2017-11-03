<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Chude extends Model
{
    protected $table        = 'chude';
    protected $fillable     = ['cd_ten', 'cd_dienGiai'];

    protected $guarded      = ['cd_ma'];
    protected $primaryKey   = 'cd_ma';

    public $timestamps = true;

    public function getCreatedAtAttribute($value) 
	{
		Carbon::setLocale('vi');
		return Carbon::createFromFormat('Y-m-d H:i:s', $value)->diffForHumans();
	}

	public function coLoaiSanPham()
    {
     return $this->hasMany('App\Loaisanpham', 'cd_ma', 'cd_ma');
    }
}
