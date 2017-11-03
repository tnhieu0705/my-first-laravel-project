<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietPhieunhapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiet_phieunhap', function (Blueprint $table) {
            $table->unsignedBigInteger('pn_ma')->comment('Mã phiếu nhập');
            $table->unsignedBigInteger('sp_ma')->comment('Mã sản phẩm');
            $table->unsignedSmallInteger('ctn_soLuong')->default('1')->comment('Số lượng sản phẩm nhập kho');
            $table->unsignedInteger('ctn_donGia')->default('1')->comment('Giá nhập kho của sản phẩm');

            $table->primary(['pn_ma', 'sp_ma']);
            $table->foreign('pn_ma')->references('pn_ma')->on('phieunhap')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('sp_ma')->references('sp_ma')->on('sanpham')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chitiet_phieunhap');
    }
}
