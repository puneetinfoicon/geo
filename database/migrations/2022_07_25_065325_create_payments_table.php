<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('customerNo');
            $table->string('orderid')->nullable();
            $table->string('txnid')->nullable();
            $table->string('reference')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('feeid')->nullable();
            $table->string('txnfee')->nullable();
            $table->string('paymenttype')->nullable();
            $table->string('hash')->nullable();
            $table->string('status')->nullable();
            $table->string('orderReference')->nullable();
            $table->string('details')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
