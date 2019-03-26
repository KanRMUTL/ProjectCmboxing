<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatsTable extends Migration
{
    public function up()
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->integer('group');
            $table->integer('ticket_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
