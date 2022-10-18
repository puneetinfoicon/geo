<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterDescriptionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {

            $table->string('inholder_title')->after('inholder')->default('Indeholder');

            $table->string('specification_title')->after('specfication')->default('Specfication');

            $table->string('specification2_title')->after('specfication')->default('Specfication');
            $table->longText('specification2')->after('specfication')->nullable();
            
            $table->string('specification3_title')->after('specfication')->default('Specfication');
            $table->longText('specification3')->after('specfication')->nullable();
            
            $table->string('specification4_title')->after('specfication')->default('Specfication');
            $table->longText('specification4')->after('specfication')->nullable();

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
