<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseSaleCoursesTable extends Migration
{
   
    public function up()
    {
        Schema::create('sale_courses', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->timestamp('created_at'); // timestamp
            $table->integer('user_id'); // int(11)
            $table->integer('course_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_courses');
    }
}
