<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKhuyenmaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('khuyenmai', function (Blueprint $table) {
            $table->bigIncrements('km_ma')->comment('Mã chương trình khuyến mãi');
            $table->string('km_ten', 200)->comment('Tên chương trình khuyến mãi');
            $table->text('km_noiDung')->comment('Nội dung chi tiết chương trình khuyến mãi');
            $table->dateTime('km_batDau')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Thời điểm lập kế hoạch khuyến mãi');
            $table->dateTime('km_ketThuc')->nullable()->default(NULL)->comment('Thời điểm kết thúc khuyến mãi');
            $table->unsignedTinyInteger('km_trangThai')->default('2')->comment('Trạng thái chương trình khuyến mãi: 1-ngưng khuyến mãi, 2-lập kế hoạch, 3-duyệt kế hoạch');
            $table->timestamps();

            $table->unique(['km_ten']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('khuyenmai');
    }
}
