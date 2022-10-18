<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaticSearchCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('static_search_category', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('page_id')->unsigned()->index();
            //$table->foreign('page_id')->references('id')->on('pagebuilder__pages')->onDelete('cascade');
            $table->bigInteger('search_category_id')->unsigned()->index()->nullable();
            $table->foreign('search_category_id')->references('id')->on('search_categories')->onDelete('cascade');
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
        Schema::dropIfExists('static_search_category');
    }
}
