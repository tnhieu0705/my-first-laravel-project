<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hinhanh extends Model
{
    protected $table = 'hinhanh';
	protected $fillable = ['ha_ten'];

	protected $guarded = ['sp_ma', 'ha_stt'];

	protected $primaryKey = 'ha_ma';
	// protected $primaryKey = ['sp_ma', 'h_stt'];
	public $timestamps = false;

	public function thuocSanPham() 
	{
		return $this->belongsTo('App\Sanpham', 'sp_ma', 'sp_ma');
	}
}
