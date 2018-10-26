<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->unique()->comment("商铺名");
            $table->string('img')->comment("图片");
            $table->boolean('brand')->comment("是不是品牌");
            $table->boolean('time')->comment("是不是准时达");
            $table->boolean('fengniao')->comment("是不是蜂鸟配送");
            $table->boolean('bao')->comment("是不是 保");
            $table->boolean('piao')->comment("是不是 票");
            $table->decimal('start_send')->comment("起送金额");
            $table->decimal('send_cost')->comment("配送费");
            $table->string('notice')->comment("店铺公告");
            $table->string('discount')->comment("优惠信息");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
