<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->id();
            $table->BigInteger('phone_no')->nullable();
            $table->integer('age')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('education')->nullable();
            $table->string('profession')->nullable();
            $table->string('workplace')->nullable();
            $table->mediumText('about')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
};
