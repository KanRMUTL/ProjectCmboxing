<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuesthousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guesthouses', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->string('name',50);
            $table->integer('zone_id'); // int(11)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guesthouses');
    }
}
