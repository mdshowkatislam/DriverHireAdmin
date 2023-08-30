<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDriverOnlineLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('driver_online_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id')->nullable();

            $table->enum('status', [
                'online', 'offline'
            ]);

            $table->foreign('driver_id')
                ->on('users')
                ->references('id')
                ->nullOnDelete();
            $table->dateTime('date_time');
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
        Schema::dropIfExists('driver_online_logs');
    }
}
