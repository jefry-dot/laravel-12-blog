<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Phone;
use App\Models\User;

class PhoneSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan ada user di database
        if (User::count() === 0) {
            $this->command->warn("Tidak ada user di database. Menambahkan user baru...");
            User::factory(10)->create(); // Buat 10 user baru jika belum ada
        }

        // Ambil semua user yang ada dan buat phone berdasarkan id user
        User::all()->each(function ($user) {
            Phone::factory()->create([
                'user_id' => $user->id, // Set user_id sesuai urutan ID user
            ]);
        });
    }
}

