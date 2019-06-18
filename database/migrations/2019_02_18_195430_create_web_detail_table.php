<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebDetailTable extends Migration
{

    public function up()
    {
        Schema::create('web_detail', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email', 30);
            $table->string('phone', 10);
            $table->text('about');
            $table->string('facebook', 100);
            $table->string('line_token', 100);
            $table->integer('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('web_detail');
    }
}
