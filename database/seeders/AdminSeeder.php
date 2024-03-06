<?php

namespace Database\Seeders;

// database/seeders/AdminSeeder.php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // Add this line to import the User model

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123'), // Change this to a secure password
            'role' => 'admin',
        ]);

        $this->command->info('Admin user created!');
    
    // Example when creating a user
    // Create a client user
        User::create([
            'name' => 'Client User',
            'email' => 'client@example.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_CLIENT,
        ]);

        // Create a seller user
        User::create([
            'name' => 'Seller User',
            'email' => 'seller@example.com',
            'password' => Hash::make('password'),
            'role' => User::ROLE_SELLER,
        ]);

        // Add more users as needed

        // You can use the factory to create additional random users
        \App\Models\User::factory(10)->create();

}
}

