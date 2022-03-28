<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToInwardEntryItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inward_entry_items', function (Blueprint $table) {
            $table->string('insera_code')->nullable();
            $table->string('description_on_box')->nullable();
            $table->string('fork')->nullable();
        });
    }
}
