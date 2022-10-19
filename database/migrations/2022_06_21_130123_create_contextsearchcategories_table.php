<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContextsearchcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contextsearchcategories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('search_category_id');
            $table->unsignedBigInteger('context_id');
            $table->timestamps();

            $table->foreign('context_id')->references('id')->on('contexts')->onDelete('cascade');
            $table->foreign('search_category_id')->references('id')->on('search_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contextsearchcategories');
    }
}
