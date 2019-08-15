<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeatRegistersTable extends Migration
{
    public function up()
    {
        Schema::create('seat_registers', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit'); // date
            $table->integer('sale_ticket_id'); // int(11)
            $table->integer('seat_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('seat_registers');
    }
}
