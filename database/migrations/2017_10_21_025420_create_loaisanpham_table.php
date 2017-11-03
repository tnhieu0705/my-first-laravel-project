<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoaisanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loaisanpham', function (Blueprint $table) {
            $table->unsignedTinyInteger('l_ma')->autoIncrement()->comment('Mã loại sản phẩm');
            $table->string('l_ten', 50)->comment('Tên loại sản phẩm');
            $table->tinyInteger('l_trangThai')->default('2')->comment('Trạng thái loại sản phẩm: 1-khóa, 2-khả dụng');
            $table->timestamps();
            $table->unsignedTinyInteger('cd_ma')->comment('Mã chủ đề');

            $table->unique(['l_ten']);
            $table->foreign('cd_ma')->references('cd_ma')->on('chude')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loaisanpham');
    }
}
