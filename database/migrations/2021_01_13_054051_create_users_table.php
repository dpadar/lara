<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('firstname', 64);
			$table->string('lastname', 64);
			$table->string('username', 64)->unique();
			$table->string('country_code', 2);
			$table->foreign('country_code')->references('code')->on('countries');
			$table->string('password', 256);
			$table->boolean('admin');
			$table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
