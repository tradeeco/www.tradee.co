<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggedUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tagged_users', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index();
            $table->integer('tagged_user_id')->unsigned()->index();
            $table->tinyInteger('tag')->unsigned()->default(0)->comment('0: interested, 1: shortlisted, 2: selected');
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
    }
}
