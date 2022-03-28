<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNullableForInwardEntry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inward_entries', function (Blueprint $table) {
            $table->string('boe_number')->nullable()->change();
            $table->string('import_invoice_number')->nullable()->change();
        });

        Schema::table('inward_entry_items', function (Blueprint $table) {
            $table->string('frame_number')->nullable()->change();
        });
    }
}
