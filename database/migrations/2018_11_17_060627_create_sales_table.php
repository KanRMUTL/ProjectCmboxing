<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount');
            $table->decimal('total',8,2);
            $table->string('customer_name',30);
            $table->string('customer_phone', 10);
            $table->string('customer_room',10);
            $table->date('visit'); //วันที่ลูกค้าเข้ามาชมมวย
            $table->timestamp('created_at')->useCurrent();
            $table->integer('ticket_id');
            $table->integer('guesthouse_id');
            $table->integer('sale_type');
            $table->integer('zone_id');
            $table->integer('user_id');
        });
    }

    public function down()
    {
        Schema::drop('sales');
    }
}
