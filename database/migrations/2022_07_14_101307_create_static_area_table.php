<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticAreaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_area', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->index();
            //$table->foreign('page_id')->references('id')->on('pagebuilder__pages')->onDelete('cascade');
            $table->bigInteger('area_id')->unsigned()->index()->nullable();
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
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
        Schema::dropIfExists('static_area');
    }
}
