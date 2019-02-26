<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('course_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('start_course');
            $table->integer('sale_course_id');
            $table->integer('trainer_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_registers');
    }
}
