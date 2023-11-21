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
        Schema::table('archive_statement_models', function (Blueprint $table) {
            $table->integer('unfulfilled')->default(0)->after('id');
            $table->longText('description')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archive_statement_models', function (Blueprint $table) {
            $table->dropColumn('unfulfilled');
        });
    }
};
