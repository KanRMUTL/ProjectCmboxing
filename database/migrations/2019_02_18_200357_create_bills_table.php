<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id'); //int(10)
            $table->decimal('total', 8, 2); //decimal(8,2)
            $table->timestamp('created_at'); // dateTime
            $table->integer('user_id'); // int(11)
        });
    }

    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
