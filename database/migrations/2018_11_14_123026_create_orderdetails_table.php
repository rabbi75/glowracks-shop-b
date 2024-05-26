<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderdetails', function (Blueprint $table) {
            $table->increments('orderDetails');
            $table->integer('orderId');
            $table->integer('ProductId');
            $table->string('productName');
            $table->string('productSize')->nullable();
            $table->string('productColor')->nullable();
            $table->float('productPrice',10,2);
            $table->float('proPurchaseprice',10,2);
            $table->integer('productQuantity');
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
        Schema::dropIfExists('orderdetails');
    }
}
