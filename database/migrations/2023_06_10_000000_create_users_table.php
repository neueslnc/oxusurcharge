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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('login');
            $table->string('full_name');
            $table->string('email')->unique()->nullable();
            $table->integer('level_id');
            $table->foreign('level_id')->references('id')->on('user_levels');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string("role")->nullable();
            $table->integer("departament_id")->nullable();
            $table->foreign('departament_id')->references('id')->on('departaments');
            $table->integer('percent')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
