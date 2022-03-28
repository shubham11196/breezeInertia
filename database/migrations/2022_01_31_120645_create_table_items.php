<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sku');
            $table->string('frame_number')->nullable();
            $table->string('short_name');
            $table->string('description');
            $table->string('model');
            $table->string('color');
            $table->string('size');
            $table->string('marin_code');
            $table->string('barcode_color');
            $table->string('type');
            $table->integer('grn_number');
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
       
    }
}
