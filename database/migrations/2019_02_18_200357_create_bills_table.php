<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('total', 8, 2);
            $table->timestamp('created_at');
            $table->integer('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
