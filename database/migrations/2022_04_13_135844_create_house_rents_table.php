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
        Schema::create('house_rents', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->id();
            $table->double('amount')->nullable();
            $table->string('created_by')->nullable();
            $table->string('bill_image')->nullable();
            $table->string('path')->nullable();
            $table->string('month')->nullable();
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
        Schema::dropIfExists('house_rents');
    }
};
