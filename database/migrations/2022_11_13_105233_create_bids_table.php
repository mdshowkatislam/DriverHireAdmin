<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->id();
            $table->string('bid_id')->unique();
            $table->unsignedBigInteger('hire_request_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->float('bid_amount');
            $table->text('note')->nullable();
            $table->boolean('status');

            $table->foreign('hire_request_id')
                ->on('hire_requests')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('driver_id')
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
        Schema::dropIfExists('bids');
    }
}
