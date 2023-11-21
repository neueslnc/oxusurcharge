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
        Schema::create('play_mobile', function (Blueprint $table) {
            $table->id();
            $table->integer('sender_id');
            $table->foreign('sender_id')->references('id')->on('users');
            $table->string('sms_body',130)->nullable();
            $table->integer('taker_id');
            $table->foreign('taker_id')->references('id')->on('users');
            $table->string('message_id');
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
        Schema::dropIfExists('play_mobile');
    }
};
