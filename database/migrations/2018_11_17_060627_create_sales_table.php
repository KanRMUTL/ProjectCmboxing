<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->integer('total');
            $table->string('customer_name',100);
            $table->string('customer_phone', 11);
            $table->string('customer_room',6);
            $table->date('visit'); //วันที่ลูกค้าเข้ามาชมมวย
            $table->integer('ticket_id');
            $table->integer('user_id');
            $table->integer('guesthouse_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sales');
    }
}
