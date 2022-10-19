<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterRemiveEditProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('sku');
            $table->renameColumn('name', 'api_name');
            
            $table->string('api_id')->after('id');
            $table->longText('description')->change();
            $table->longText('short_text')->after('description');
            $table->longText('specfication')->after('description');
            $table->longText('inholder')->after('description');

            $table->enum('hide_amount',['0','1'])->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
