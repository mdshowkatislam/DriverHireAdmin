<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleOwnerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_owner_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('v_owner_id')->nullable();
            $table->string('photo');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->date('dob');
            $table->boolean('status')->default(false);

            $table->foreign('v_owner_id')
                ->on('users')
                ->references('id')
                ->nullOnDelete();

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
        Schema::dropIfExists('vehicle_owner_details');
    }
}