<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhacungcapTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhacungcap', function (Blueprint $table) {
            $table->smallIncrements('ncc_ma')->comment('Mã nhà cung cấp');
            $table->string('ncc_ten', 150)->comment('Tên nhà cung cấp');
            $table->string('ncc_daiDien', 100)->comment('Người đại diện');
            $table->string('ncc_diaChi', 255)->comment('Địa chỉ nhà cung cấp');
            $table->string('ncc_dienThoai', 12)->comment('Điện thoại');
            $table->string('ncc_email', 100)->comment('Email nhà cung cấp');
            $table->tinyInteger('ncc_trangThai')->default('2')->comment('Trạng thái nhà cung cấp: 1-khóa, 2-khả dụng');
            $table->timestamps();

            $table->unique(['ncc_ten', 'ncc_dienThoai', 'ncc_email']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhacungcap');
    }
}
