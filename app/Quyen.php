<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quyen extends Model
{
    protected $table        = 'quyen';
    protected $fillable     = ['q_ten', 'q_dienGiai'];

    protected $guarded      = ['q_ma'];
    protected $primaryKey   = 'q_ma';

    public $timestamps = true;

    public function coNhanVien()
    {
    	return $this->hasMany('App\Nhanvien', 'q_ma', 'q_ma');
    }
}
