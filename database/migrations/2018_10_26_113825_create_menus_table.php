<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment("菜名");
            $table->integer('rating')->comment("评分");
            $table->integer('shop_id')->comment("商家id");
            $table->integer('cate_id')->comment("分类id");
            $table->integer('price')->comment("价格");
            $table->string('descr')->comment("描述");
            $table->integer('month_sale')->comment("月销量");
            $table->integer('rating_count')->comment("总评分");
            $table->string('tips')->comment("提示信息");
            $table->integer('staisfy_count')->comment("满意度数量");
            $table->integer('staisfy_rate')->comment("满意度评分");
            $table->string('img')->comment("商品图片");
            $table->integer('status')->comment("状态 1商家 0 下架");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menus');
    }
}
