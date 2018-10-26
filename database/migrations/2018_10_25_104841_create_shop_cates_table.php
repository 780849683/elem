<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_cates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment("分类名");
            $table->string('img')->comment("分类图片");
            $table->boolean('status')->comment("状态");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_cates');
    }
}
