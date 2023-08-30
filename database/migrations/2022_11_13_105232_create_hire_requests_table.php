<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHireRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hire_requests', function (Blueprint $table) {
            $table->id();
            $table->string('hire_id')->unique();
            $table->unsignedBigInteger('v_owner_id')->nullable();
            $table->unsignedBigInteger('v_id')->nullable();
            $table->unsignedBigInteger('bid_winner_id')->nullable();
            $table->unsignedBigInteger('accepted_bid_id')->nullable();

            $table->string('from_location');
            $table->string('to_location');
            $table->string('return_location')->nullable();
            $table->string('note')->nullable();
            $table->enum('hire_status' ,[
                'pending', 'accepted', 'ride_started', 'ride_completed', 'ride_cancel', 'unknown'
            ]);
            $table->boolean('status');
            $table->dateTime('trip_date_time');
            $table->dateTime('trip_end_date_time');

            $table->foreign('v_owner_id')
                ->on('users')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('v_id')
                ->on('vehicles')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('bid_winner_id')
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
        Schema::dropIfExists('hire_requests');
    }
}
