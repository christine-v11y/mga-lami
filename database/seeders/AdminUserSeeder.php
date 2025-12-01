<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check first if admin already exists (optional but recommended)
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name'     => 'Admin',
                'email'    => 'admin@example.com',
                'password' => Hash::make('password123'), // ilisi kung gusto nimo
                'role'     => 0, // 0 = admin
            ]);
        }
    }
}