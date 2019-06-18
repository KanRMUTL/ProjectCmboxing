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
            $table->string('name', 30); // varchar(30)
            $table->integer('group'); // int(11)
            $table->integer('ticket_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('seats');
    }
}
