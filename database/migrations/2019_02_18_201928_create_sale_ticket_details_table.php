<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTicketDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_ticket_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount'); // int(11)
            $table->decimal('total', 8, 2); // decimal(8,2)
            $table->integer('ticket_id');  // int(11)
            $table->integer('sale_ticket_id'); // int(11)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_ticket_details');
    }
}
