<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import Model User
use Illuminate\Support\Facades\Hash; // <-- Import Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Script untuk membuat user admin
        User::create([
            'name' => 'Admin Utama',
            'nim' => 'ADMIN001', // (Bisa diisi apa saja)
            'email' => 'admin@unhas.ac.id', // (Email login admin)
            'password' => Hash::make('password123'), // (Password login admin)
            'role' => 'admin', // <-- Peran sebagai admin
        ]);
    }
}