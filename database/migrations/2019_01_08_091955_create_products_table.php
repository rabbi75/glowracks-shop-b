<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('proCategory');
            $table->integer('proSubcategory');
            $table->integer('proChildCategory')->nullable();
            $table->integer('proBrand')->nullable();
            $table->integer('proShop')->nullable();
            $table->text('proName');
            $table->text('slug');
            $table->integer('proOldprice')->nullable();
            $table->integer('proPurchaseprice');
            $table->integer('proNewprice');
            $table->string('proCode')->nullable();
            $table->longText('proDescription');
            $table->string('proQuantity')->nullable();
            $table->string('aditionalshipping')->nullable();
            $table->string('dealdate')->nullable();
            $table->tinyInteger('fullpaid')->nullable();
            $table->tinyInteger('deal')->nullable();
            $table->tinyInteger('bestsell')->nullable();
            $table->tinyInteger('feature')->nullable();
            $table->string('video')->nullable();
            $table->tinyInteger('status');
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
        Schema::dropIfExists('products');
    }
}
