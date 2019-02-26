<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    // OK
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('firstname',30);
            $table->string('lastname',30);
            $table->string('username',10);
            $table->string('email',30)->unique();
            $table->string('phone_number', 10);
            $table->longText('address');
            $table->string('password');
            $table->tinyInteger('role'); // 1.admin 2.หัวหน้าฝ่ายการตลาด 3.พนักงานฝ่ายการตลาด 4.สมาชิก
            $table->rememberToken();
        });
    }

    public function down()
    {
        Schema::drop('users');
    }
}
