<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeveloperTechnologyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('developer_technology', function (Blueprint $table) {
            $table->integer('developer_id')->unsigned()->index();
            $table->foreign('developer_id')->references('id')->on('developers')->onDelete('cascade');
            $table->integer('technology_id')->unsigned()->index();
            $table->foreign('technology_id')->references('id')->on('technologies')->onDelete('cascade');
            $table->primary(['developer_id', 'technology_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('developer_technology');
    }
}
