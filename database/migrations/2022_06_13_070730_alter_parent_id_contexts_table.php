<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterParentIdContextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contexts', function (Blueprint $table) {
            
            $table->unsignedBigInteger('parent_id')->nullable()->after('description');
            $table->foreign('parent_id')->references('id')->on('contexts')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('contexts', function (Blueprint $table) {
            //
        });
    }
}
