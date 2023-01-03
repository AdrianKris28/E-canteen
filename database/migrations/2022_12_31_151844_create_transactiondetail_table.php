<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactiondetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactiondetail', function (Blueprint $table) {
            $table->foreignId('transactionId')->references('id')->on('transaction')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('productId')->references('id')->on('product')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('qty');
            $table->primary(array('transactionId', 'productId'));
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
        Schema::dropIfExists('transactiondetail');
    }
}
