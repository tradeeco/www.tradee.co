<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('username', 25)->nullable(false);
            $table->string('email', 25)->unique();
            $table->string('first_name', 25);
            $table->string('last_name', 25);
            $table->string('phone', 32);
            $table->string('address', 100);
            $table->string('password');
            $table->string('post_code', 25);
            $table->rememberToken();
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
		Schema::drop('users');
	}

}
