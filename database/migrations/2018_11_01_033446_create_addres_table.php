<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addres', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name')->comment("收货人");
            $table->string('tel')->comment("联系方式");
            $table->string('provence')->comment("省");
            $table->string('city')->comment("市");
            $table->string('area')->comment("区");
            $table->string('detail_address')->comment("详细地址");
            $table->integer('member_id')->comment("用户id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addres');
    }
}
