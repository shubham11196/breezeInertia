<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableOutwardEntryItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outward_entry_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('outward_entry_id');
            $table->foreign('outward_entry_id')->references('id')->on('outward_entries');
            $table->string('frame_number');
            $table->string('upc_or_sku');
            $table->string('grn_number');
            $table->string('boe_number')->nullable();
            $table->string('short_name')->nullable();
            $table->string('model');
            $table->string('marin_code')->nullable();
            $table->string('color_of_barcode')->nullable();
            $table->string('color')->nullable();
            $table->string('size');
            $table->string('type');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }
}
