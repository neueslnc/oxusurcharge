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
        Schema::table('play_mobile', function (Blueprint $table) {
            $table->integer('status_sms')->unsigned()->after('message_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('play_mobile', function (Blueprint $table) {
            $table->dropColumn('status_sms');
        });
    }
};
