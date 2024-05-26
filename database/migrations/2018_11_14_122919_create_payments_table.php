<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('paymentIdPrimary');
            $table->integer('orderId');
            $table->string('paymentType');
            $table->string('senderId')->nullable();
            $table->string('transectionId')->nullable();
            $table->string('paymentStatus')->default('pending');
            $table->integer('bkashFee')->nullable();
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
