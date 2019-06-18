<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->string('name', 30); //varchar(30)
            $table->decimal('price', 8, 2); // decimal(8,2)
            $table->text('detail'); // text
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
