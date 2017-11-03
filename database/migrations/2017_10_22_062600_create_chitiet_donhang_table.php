<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChitietDonhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chitiet_donhang', function (Blueprint $table) {
            $table->unsignedBigInteger('dh_ma')->comment('Mã đơn hàng');
            $table->unsignedBigInteger('sp_ma')->comment('Mã sản phẩm');
            $table->unsignedSmallInteger('ctdh_soLuong')->default('1')->comment('Số lượng sản phẩm đặt mua');
            $table->unsignedInteger('ctdh_donGia')->default('1')->comment('Giá bán');

            $table->primary(['dh_ma', 'sp_ma']);
            $table->foreign('dh_ma')->references('dh_ma')->on('donhang')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('chitiet_donhang');
    }
}
