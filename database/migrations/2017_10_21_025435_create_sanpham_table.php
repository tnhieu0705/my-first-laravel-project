<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->bigIncrements('sp_ma')->comment('Mã sản phẩm');
            $table->string('sp_ten', 200)->comment('Tên sản phẩm # Tên sản phẩm');
            $table->unsignedInteger('sp_giaGoc')->default('0')->comment('Giá gốc của sản phẩm');
            $table->unsignedInteger('sp_giaBan')->default('0')->comment('Giá bán hiện tại của sản phẩm');
            $table->text('sp_thongTin')->nullable()->comment('Thông tin về sản phẩm');
            $table->unsignedSmallInteger('sp_soLuong')->default('0')->comment('Số lượng sản phẩm tồn kho');
            $table->string('sp_xuatXu', 50)->comment('Xuất xứ của sản phẩm');
            $table->string('sp_hinh', 255)->nullable()->comment('Hình đại diện của sản phẩm');
            $table->tinyInteger('sp_trangThai')->default('2')->comment('Trạng thái sản phẩm: 1-khóa, 2-khả dụng');
            $table->timestamps();
            $table->unsignedTinyInteger('l_ma')->comment('Mã loại sản phẩm');

            $table->unique(['sp_ten']);
            $table->foreign('l_ma')->references('l_ma')->on('loaisanpham')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sanpham');
    }
}
