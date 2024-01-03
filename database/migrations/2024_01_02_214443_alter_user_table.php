<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('skill')->nullable();
            $table->string('country')->nullable();
            $table->string('district')->nullable();
            $table->json('interested_in')->nullable();
            $table->string('number')->nullable();
            $table->json('startup_state')->nullable();
            $table->json('successful_startups')->nullable();
            $table->json('startup_names')->nullable();
            $table->json('startup_funded')->nullable();
            $table->json('mostly_interected_with')->nullable();
            $table->unsignedBigInteger('intereted_with')->nullable();
            $table->foreign('intereted_with')->references('id')->on('users');
            $table->json('type_of_people_interected_with')->nullable();
            $table->json('others')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
        });
    }
}
