<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat 10 user dengan nomor telepon otomatis
        User::factory(10)->create();
    }
}
