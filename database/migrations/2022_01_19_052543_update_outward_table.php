<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateOutwardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outward_entries', function (Blueprint $table) {
            $table->dropColumn('shipped_by');
            $table->string('description');
            $table->string('marin_code');
            $table->string('short_name');
            $table->date('dispatch_date')->nullable();
            $table->time('dispatch_time');
            $table->string('ship_to_party');
            $table->string('bill_to_party');
            $table->string('destination_code');
            $table->string('vehical_no');
            $table->string('lr_number');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
