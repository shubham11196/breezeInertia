<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductMakeColumnNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('model')->nullable()->change();
            $table->string('description')->nullable()->change();
            $table->string('size')->nullable()->change();
            $table->string('barcode_color')->nullable()->change();
            $table->string('type')->nullable()->change();
            $table->string('marin_code')->nullable()->change();
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
