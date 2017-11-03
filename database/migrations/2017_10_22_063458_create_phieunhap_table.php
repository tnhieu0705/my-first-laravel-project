<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->bigIncrements('pn_ma')->comment('Mã phiếu nhập');
            $table->unsignedSmallInteger('nv_nguoiLapPhieu')->comment('Mã nhân viên (người lập phiếu nhập)');
            $table->dateTime('pn_ngayLapPhieu')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('hời điểm lập phiếu nhập kho');
            $table->unsignedSmallInteger('ncc_ma')->comment('Nhà cung cấp # ncc_ma # ncc_ten # Mã nhà cung cấp');
            $table->tinyInteger('pn_trangThai')->default('2')->comment('Trạng thái phiếu nhập sản phẩm: 1-khóa, 2-lập phiếu, 3-thanh toán');
            $table->timestamps();

            $table->foreign('nv_nguoiLapPhieu')->references('nv_ma')->on('nhanvien')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('ncc_ma')->references('ncc_ma')->on('nhacungcap')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phieunhap');
    }
}
