<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generalsettings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename');
            $table->text('metadescrp');
            $table->text('metatag');
            $table->text('googleanyh');
            $table->text('googleanybo');
            $table->text('facebookpixh');
            $table->text('facebookpixbo');
            $table->text('facebookmessh');
            $table->text('facebookmessbo');
            $table->text('googleconh');
            $table->text('googleconbo');
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
        Schema::dropIfExists('generalsettings');
    }
}
