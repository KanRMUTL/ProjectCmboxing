<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zones', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30);
            $table->string('latitude', 100);
            $table->string('longitude', 100);
        });
    }

    public function down()
    {
        Schema::drop('zones');
    }
}
