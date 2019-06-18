<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id'); // int(10)
            $table->integer('amount'); // int(11)
            $table->decimal('total',8,2); // decimal(8,2)
            $table->string('customer_name',30); // varchar(30)
            $table->string('customer_phone', 10); // varchar(10)
            $table->string('customer_room',10); // varchar(10)
            $table->date('visit'); // date
            $table->timestamp('created_at')->useCurrent(); // timestamp
            $table->integer('ticket_id'); // int(11)
            $table->integer('guesthouse_id'); // int(11)
            $table->integer('sale_type'); // int(11)
            $table->integer('zone_id'); // int(11)
            $table->integer('user_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::drop('sales');
    }
}
