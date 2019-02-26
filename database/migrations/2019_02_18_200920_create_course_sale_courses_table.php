<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSaleCoursesTable extends Migration
{
   
    public function up()
    {
        Schema::create('sale_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('user_id');
            $table->integer('course_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_courses');
    }
}
