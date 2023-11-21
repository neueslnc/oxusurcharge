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
        Schema::create('archive_criteria', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('user_id');
            $table->foreign("user_id")->references('id')->on('users');
            $table->string("data");
            $table->string("increase");
            $table->integer('criteria_id');
            $table->foreign("criteria_id")->references('id')->on('criterias');
            $table->integer("status")->default(0);
            $table->json("states")->nullable();
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
        Schema::dropIfExists('archive_criteria_models');
    }
};
