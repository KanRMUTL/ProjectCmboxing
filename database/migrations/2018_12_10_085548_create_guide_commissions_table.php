<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuideCommissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_commissions', function (Blueprint $table) {
            $table->increments('id');  // int(10)
            $table->decimal('commission',8,2); // decimal(8,2)
            // $table->smallInteger('ticket_id'); // smallInt(6)
            $table->integer('ticket_id'); // int(11)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('guide_commissions');
    }
}
