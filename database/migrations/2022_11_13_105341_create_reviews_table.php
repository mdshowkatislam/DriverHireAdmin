<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('hire_request_id')->nullable();
            $table->unsignedBigInteger('rate_by')->nullable();
            $table->unsignedBigInteger('rate_to')->nullable();
            $table->text('review_text')->nullable();
            $table->integer('rating')->default(0);

            $table->foreign('hire_request_id')
                ->on('hire_requests')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('rate_by')
                ->on('users')
                ->references('id')
                ->nullOnDelete();

            $table->foreign('rate_to')
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
        Schema::dropIfExists('reviews');
    }
}
