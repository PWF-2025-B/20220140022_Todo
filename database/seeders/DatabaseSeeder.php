<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Todo;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => true,
        ]);

        // User biasa (ganti dengan data kamu)
        User::factory()->create([
            'name' => 'Muhamad Adri Muwafaq Khamid', // Ganti dengan nama lengkap kamu
            'email' => 'adri.example@mail.com', // Ganti dengan email kamu
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'is_admin' => false,
        ]);

        // Tambahan data dummy
        User::factory(100)->create();
        Category::factory(200)->create();
        Todo::factory(500)->create();
    }
}
