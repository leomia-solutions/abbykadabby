<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMeasurementFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropColumn('units');
            $table->string('weight_units');
            $table->dropColumn('price_per_unit');
            $table->float('price');
            $table->float('weight');
            $table->string('price_units');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropColumn('price_units');
            $table->dropColumn('weight');
            $table->dropColumn('price');
            $table->float('price_per_unit');
            $table->dropColumn('weight_units');
            $table->string('units');
        });
    }
}
