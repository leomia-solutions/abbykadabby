<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNameFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->rename('name', 'first_name');
            $table->string('last_name');
            $table->string('first_name_lower');
            $table->string('last_name_lower');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('uses', function (Blueprint $table) {
            $table->rename('first_name', 'name');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name_lower');
            $table->dropColumn('last_name_lower');
        });
    }
}
