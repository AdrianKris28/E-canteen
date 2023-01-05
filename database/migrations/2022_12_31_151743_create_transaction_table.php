<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buyerId')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('paymentMethodId')->references('id')->on('payment')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('flag')->length(1);
            $table->string('orderType', 10)->nullable(true);
            $table->integer('tableNumber')->nullable(true)->length(5);
            $table->date('transactionDate');
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
        Schema::dropIfExists('transaction');
    }
}
