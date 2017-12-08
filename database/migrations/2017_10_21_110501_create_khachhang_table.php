<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhachhangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khachhang', function (Blueprint $table) {
            $table->bigIncrements('kh_ma')->comment('Mã khách hàng');
            $table->string('kh_hoTen', 100)->comment('Họ tên khách hàng');
            $table->unsignedTinyInteger('nv_gioiTinh')->default('1')->comment('Giới tính: 1-Nam, 2-Nữ');
            $table->string('kh_diaChi', 255)->nullable()->default('NULL')->comment('Địa chỉ khách hàng');
            $table->string('kh_dienThoai', 12)->nullable()->default('NULL')->comment('Số điện thoại khách hàng');
            $table->string('kh_email', 100)->comment('Email khách hàng');
            $table->string('kh_matKhau', 64)->comment('Mật khẩu');
            $table->unsignedTinyInteger('kh_nhom')->default('1')->comment('Nhóm khách hàng: 1-thường, 2-thân thiết');
            $table->timestamps();

            $table->unique(['kh_email', 'kh_dienThoai']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khachhang');
    }
}
