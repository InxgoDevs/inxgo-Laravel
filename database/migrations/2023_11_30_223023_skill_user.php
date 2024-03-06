<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SkillUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('skill_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('skill_id')->constrained();
        $table->foreignId('user_id')->constrained();
        $table->string('image')->nullable(); // Add the image column
       // $table->timestamps();
    });
}






    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('skill_user');
    }
}
