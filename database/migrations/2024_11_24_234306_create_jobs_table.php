<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->text('description');
            $table->decimal('price_per_hour', 8, 2);
            $table->string('client_name');
            $table->string('seller_name')->nullable();
            $table->string('seller_location')->nullable();
            $table->enum('status', ['assigned', 'in_progress', 'completed', 'payment_being_cleared'])->default('assigned');
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
        Schema::dropIfExists('jobs');
        $table->dropTimestamps();
    }
}
