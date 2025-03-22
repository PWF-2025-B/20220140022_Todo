<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Todo;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cek apakah user sudah ada agar tidak duplikat
        if (!User::where('email', 'admin@admin.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Gunakan Hash::make untuk keamanan
                'remember_token' => Str::random(10),
                'is_admin' => true
            ]);
        }

        // Menjalankan factory untuk membuat data dummy
        User::factory(100)->create();
        Todo::factory(500)->create();
    }
}
