<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuCatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_cates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment("分类名");
            $table->string('num')->comment("编号");
            $table->integer('shop_id')->comment("所属商家id");
            $table->string('desc')->comment("描述");
            $table->string('is_select')->comment("是否默认分类");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_cates');
    }
}
