<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Phone;

class UpdateUserPhoneSeeder extends Seeder
{
    public function run(): void
    {
        User::all()->each(function ($user) {
            // Cari nomor HP berdasarkan user_id
            $phone = Phone::where('user_id', $user->id)->first();

            if ($phone) {
                $user->phone_id = $phone->id; // Update phone_id di users
                $user->save();
            }
        });

        $this->command->info("Kolom phone_id di tabel users berhasil diisi!");
    }
}
