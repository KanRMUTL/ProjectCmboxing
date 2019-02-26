<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->decimal('price', 8, 2);
            $table->text('detail');
        });
    }

    public function down()
    {
        Schema::dropIfExists('courses');
    }
}
