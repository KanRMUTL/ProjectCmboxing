<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainersTable extends Migration
{
  
    public function up()
    {
        Schema::create('trainers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->text('detail');
            $table->string('img', 100);
        });
    }

    public function down()
    {
        Schema::dropIfExists('trainers');
    }
}
