<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewTableInwardEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inward_entry', function (Blueprint $table) {
            $table->id();
            $table->string('sku');
            $table->integer('frame_number');
            $table->string('name');
            $table->string('model_number');
            $table->string('color');
            $table->string('size');
            $table->integer('boe_number');
            $table->dateTime('boe_date');
            $table->integer('truck_number');
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
        // Schema::dropIfExists('new_table_inward_entry');
    }
}
