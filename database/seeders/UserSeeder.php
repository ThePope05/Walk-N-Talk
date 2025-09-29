<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // lookup by email
            [
                'firstName' => 'Admin',
                'lastName'  => 'User',
                'tribe'     => 'System',      // 👈 you can rename this to fit your domain
                'number'    => '0000000000',  // must be unique
                'password'  => Hash::make('admin123'), // secure password
                'email_verified_at' => now(),
            ]
        );
    }
}
