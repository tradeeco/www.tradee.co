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
            $table->string('username', 25)->unique();
            $table->string('email', 25)->unique();
            $table->string('first_name', 25)->default('');
            $table->string('last_name', 25)->default('');
            $table->string('phone', 32)->default('');
            $table->string('address', 100)->default('');
            $table->string('password');
            $table->string('post_code', 25)->default('');
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
