<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('sale_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('amount'); // int(11)
            $table->decimal('total', 8, 2); // decimal(8,2)
            $table->integer('product_id'); // int(11)
            $table->integer('bill_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_details');
    }
}
