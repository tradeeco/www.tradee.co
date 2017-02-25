<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggedJobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('tagged_jobs', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('job_id')->unsigned()->index();
            $table->integer('user_id')->unsigned()->index();
            $table->tinyInteger('tag')->unsigned()->default(0)->comment('0: watching, 1: interested, 2: shortlist');
            $table->timestamps();
        });

        Schema::table('jobs', function (Blueprint $table) {
            $table->dropColumn('watching');
            $table->dropColumn('interested');
            $table->dropColumn('shortlisted');
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
        Schema::drop('tagged_jobs');
    }
}
