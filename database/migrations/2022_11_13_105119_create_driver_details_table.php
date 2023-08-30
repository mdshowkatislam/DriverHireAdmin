<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->string('nid');
            $table->string('licence_no');
            $table->string('licence_copy_front');
            $table->string('licence_copy_back');
            $table->string('photo');
            $table->text('present_address');
            $table->text('permanent_address');
            $table->date('dob');
            $table->boolean('status')->default(false);


            $table->foreign('driver_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('driver_details');
    }
}