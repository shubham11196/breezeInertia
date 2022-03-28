<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewTableOutwardEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outward_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dispatch_date_time');
            $table->string('invoice_number');
            $table->string('dealer_name');
            $table->string('ship_to_party');
            $table->string('bill_to_party');
            $table->string('vehicle_number');
            $table->string('destination_code');
            $table->string('lr_number');
            $table->timestamps();
        });
    }
}
