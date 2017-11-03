<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donhang', function (Blueprint $table) {
            $table->bigIncrements('dh_ma')->comment('Mã đơn hàng');
            $table->unsignedBigInteger('kh_ma')->comment('Mã khách hàng');
            $table->dateTime('dh_thoiGianDatHang')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm đặt hàng');
            $table->dateTime('dh_thoiGianNhanHang')->comment('Thời điểm giao hàng theo yêu cầu của khách hàng');
            $table->string('dh_diaChi', 255)->comment('Địa chỉ người nhận');
            $table->string('dh_dienThoai', 12)->comment('Số điện thoại người nhận');
            $table->unsignedSmallInteger('nv_xuLy')->default('1')->comment('Mã nhân viên (người xử lý đơn hàng)');
            $table->unsignedTinyInteger('dh_trangThai')->default('1')->comment('Trạng thái đơn hàng: 1-nhận đơn, 2-xử lý đơn, 3-giao hàng, 4-hoàn tất, 5-đổi trả, 6-hủy');
            $table->timestamps();

            $table->foreign('kh_ma')->references('kh_ma')->on('khachhang')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('nv_xuLy')->references('nv_ma')->on('nhanvien')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donhang');
    }
}
