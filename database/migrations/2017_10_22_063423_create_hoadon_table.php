<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHoadonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoadon', function (Blueprint $table) {
            $table->bigIncrements('hd_ma')->comment('Mã hóa đơn');
            $table->unsignedSmallInteger('nv_lapHoaDon')->comment('Mã nhân viên (người lập hóa đơn)');
            $table->dateTime('hd_ngayXuatHoaDon')->comment('Thời điểm xuất hóa đơn');
            $table->unsignedBigInteger('dh_ma')->comment('Mã đơn hàng');
            
            $table->foreign('dh_ma')->references('dh_ma')->on('donhang')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('nv_lapHoaDon')->references('nv_ma')->on('nhanvien')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoadon');
    }
}
