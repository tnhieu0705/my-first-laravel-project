<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhanvienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->smallIncrements('nv_ma')->comment('Mã nhân viên');
            $table->string('nv_hoTen', 100)->comment('Họ tên nhân viên');
            $table->unsignedTinyInteger('nv_gioiTinh')->default('1')->comment('Giới tính: 1-Nam, 2-Nữ');
            $table->dateTime('nv_ngaySinh')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Ngày sinh nhân viên');
            $table->string('nv_diaChi', 255)->nullable()->comment('Địa chỉ nhân viên');
            $table->string('nv_dienThoai', 12)->nullable()->comment('Số điện thoại nhân viên');
            $table->string('nv_email', 100)->comment('Email nhân viên');
            $table->string('nv_matKhau', 64)->comment('Mật khẩu nhân viên');
            $table->timestamps();
            $table->unsignedTinyInteger('q_ma')->nullable()->comment('Mã quyền: 1-thường, 2-quản trị');

            $table->unique(['nv_email', 'nv_dienThoai']);
            $table->foreign('q_ma')->references('q_ma')->on('quyen')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhanvien');
    }
}
