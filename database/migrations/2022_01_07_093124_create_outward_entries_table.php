<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutwardEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outward_entries', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->integer('frame_number');
            $table->string('model_number');
            $table->string('color');
            $table->string('size');
            $table->integer('boe_number');
            $table->string('shipped_by');
            $table->string('docket_number');
            $table->string('invoice_number');
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
        Schema::dropIfExists('outward_entries');
    }
}
