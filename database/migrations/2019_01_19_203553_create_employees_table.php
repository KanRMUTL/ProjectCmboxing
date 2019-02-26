<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
  
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->char('id_card', 13);
            $table->integer('user_id');
            $table->integer('zone_id');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
