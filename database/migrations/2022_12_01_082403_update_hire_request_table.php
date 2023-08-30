<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHireRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hire_requests', function (Blueprint $table) {
            $table->string('from_location_lat')->after('from_location');
            $table->string('from_location_long')->after('from_location_lat');

            $table->string('to_location_lat')->after('to_location');
            $table->string('to_location_long')->after('to_location_lat');

            $table->string('return_location_lat')->after('return_location');
            $table->string('return_location_long')->after('return_location_lat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hire_requests', function (Blueprint $table) {
            $table->dropColumn('from_location_lat');
            $table->dropColumn('from_location_long');

            $table->dropColumn('to_location_lat');
            $table->dropColumn('to_location_long');

            $table->dropColumn('return_location_lat');
            $table->dropColumn('return_location_long');
        });
    }
}
