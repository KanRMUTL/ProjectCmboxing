<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('barcode', 20);
            $table->string('name', 30);
            $table->decimal('price', 8, 2);
            $table->string('unit', 30);
            $table->integer('amount');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
