<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['client', 'seller', 'admin'])->default('client'); // Adjust roles as needed
            $table->string('profile_image')->nullable();
            $table->decimal('hourly_rate', 8, 2)->default(0.00);
            $table->text('self_introduction')->nullable();
            $table->text('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamps();
           //$table->timestamps();

            // Define foreign key constraints if needed
            // Example: $table->foreignId('role_id')->constrained('roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}