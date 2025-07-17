<?php

namespace Database\Seeders;

use App\Models\User; // Importe o modelo User
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Importe Hash para criptografar a senha

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'admin@example.com',
            'password' => Hash::make('1234'), // Use Hash::make()
            'email_verified_at' => now(),
        ]);

        User::create([
            'email' => 'user@example.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);

        // Se você quiser criar muitos usuários, pode usar o factory
        // User::factory(10)->create();
    }
}