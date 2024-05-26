<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketdetails', function (Blueprint $table) {
            $table->id();
            $table->string('message');
            $table->integer('ticketId');
            $table->integer('customerId')->nullable();
            $table->integer('adminId')->nullable();
            $table->integer('isCustomer')->nullable();
            $table->integer('isAdmin')->nullable();
            $table->string('file')->nullable();
            $table->tinyInteger('status')->nullable();
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
        Schema::dropIfExists('ticketdetails');
    }
}
