<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
  
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->char('id_card', 13); // char(13)
            $table->integer('user_id'); // int(11)
            $table->integer('zone_id'); // int(11)
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
