<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activs', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title')->comment("活动名称");
            $table->text('content')->comment("活动详情");
            $table->integer('start_time')->comment("活动开始时间");
            $table->integer('end_time')->comment("活动结束时间");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activs');
    }
}
