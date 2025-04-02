<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Blog;
use App\Models\Phone;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Buat 10 user
        User::factory()
            ->count(10)
            ->has(Blog::factory()->count(3)) // Setiap user punya 3 blog
            ->has(Phone::factory()->count(1)) // Setiap user punya 1 phone
            ->create();
    }
}
