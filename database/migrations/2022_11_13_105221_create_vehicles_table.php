<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('v_name')->nullable();
            $table->string('v_type')->nullable();
            $table->string('v_year')->nullable();
            $table->string('v_model')->nullable();
            $table->string('v_chassis')->nullable();
            $table->string('v_engine')->nullable();
            $table->string('v_tax_token')->nullable();
            $table->string('v_fitness_certificate')->nullable();
            $table->string('v_root_permit')->nullable();
            $table->string('v_number_plate')->nullable();
            $table->string('v_color')->nullable();
            $table->string('v_insurance')->nullable();
            $table->boolean('status')->default(false);

            $table->foreign('user_id')
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
        Schema::dropIfExists('vehicles');
    }
}