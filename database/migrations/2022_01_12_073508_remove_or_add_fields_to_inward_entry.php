<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveOrAddFieldsToInwardEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inward_entry', function (Blueprint $table) {
            $table->dropColumn('truck_number');
            $table->string('description');
            $table->string('marin_code');
            $table->string('barcode_color');
            $table->string('type');
            $table->string('grn_number');
            $table->string('import_invoice_number');
            $table->string('location');
            $table->string('supplier');
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
