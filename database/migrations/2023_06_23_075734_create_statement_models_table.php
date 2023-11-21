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
        Schema::create('statements', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->date('date');
            $table->string("theme");
            $table->string("pair");
            $table->string("group");
            $table->string("group_name");
            $table->string("subject");
            $table->string("location");
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('status')->default(0);
            $table->string('description')->nullable();
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
        Schema::dropIfExists('statement_models');
    }
};
