<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('course_registers', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->dateTime('start_course'); // dateTime
            $table->integer('sale_course_id'); // int(11)
            $table->integer('trainer_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('course_registers');
    }
}
