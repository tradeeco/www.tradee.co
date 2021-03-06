<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_profiles', function(Blueprint $table)
        {
            $table->increments('id');
            $table->text('short_bio')->nullable();
            $table->string('origin_image_name')->nullable();;
            $table->string('image_name')->nullable();
            $table->integer('user_id')->unisigned()->index();
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
        //
        Schema::drop('user_profiles');
    }
}
