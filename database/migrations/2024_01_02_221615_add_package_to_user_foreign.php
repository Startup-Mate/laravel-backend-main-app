<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPackageToUserForeign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->timestamps();
        });
        Schema::create('user_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('transaction_id');
            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('package')->nullable();
            $table->foreign('package')->references('id')->on('packages');
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
            //
        });
    }
}
