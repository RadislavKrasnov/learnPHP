<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveFromDevelopersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->dropColumn('years/month');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('developers', function (Blueprint $table) {
            $table->string('years/month');
        });
    }
}
