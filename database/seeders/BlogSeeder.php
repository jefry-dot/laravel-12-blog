<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('blogs')->insert([
            [
                'title' => 'Belajar Laravel Dasar',
                'content' => 'Laravel adalah framework PHP yang sangat powerful...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cara Membuat Blog dengan Laravel',
                'content' => 'Pada tutorial ini kita akan membuat blog sederhana menggunakan Laravel...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
