<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterAddStatusColumnPagebuilderPagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pagebuilder__pages', function (Blueprint $table) {
            $table->enum('status',['0','1'])->default('1')->after('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pagebuilder__pages', function (Blueprint $table) {
            //
        });
    }
}
