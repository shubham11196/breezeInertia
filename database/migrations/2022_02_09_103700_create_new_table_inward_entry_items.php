<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableInwardEntryItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_entry_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('inward_entry_id');
            $table->foreign('inward_entry_id')->references('id')->on('inward_entries');
            $table->string('upc_or_sku');
            $table->string('frame_number');
            $table->string('grn_number');
            $table->string('short_name')->nullable();
            $table->string('description')->nullable();
            $table->string('model');
            $table->string('color')->nullable();
            $table->string('size');
            $table->string('marin_code')->nullable();
            $table->string('color_of_barcode')->nullable();
            $table->string('type');
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
        Schema::dropIfExists('inward_entry_items');
    }
}
