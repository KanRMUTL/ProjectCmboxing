<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleTicketsTable extends Migration
{
   
    public function up()
    {
        Schema::create('sale_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->date('visit'); // date
            $table->decimal('total', 8, 2); //decimal(8,2)
            $table->timestamp('created_at'); // timestamp
            $table->integer('user_id'); // int(11)
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('sale_tickets');
    }
}
