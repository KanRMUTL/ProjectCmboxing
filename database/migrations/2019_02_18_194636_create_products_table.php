<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');  // int(10)
            $table->char('barcode', 13); // char(13)
            $table->string('name', 30); // varchar(30)
            $table->string('img', 100); // varchar(100)
            $table->decimal('price', 8, 2); // decimal(8,2)
            $table->string('unit', 30); // varchar(30)
            $table->integer('amount'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
