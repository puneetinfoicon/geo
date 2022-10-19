<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpsnetorganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gpsnetorganizations', function (Blueprint $table) {
            $table->id();
            $table->string('api_organisation_id');
            $table->string('api_short_name');
            $table->string('api_long_name');
            $table->string('api_description');
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
        Schema::dropIfExists('gpsnetorganizations');
    }
}
