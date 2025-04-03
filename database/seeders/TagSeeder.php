<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagSeeder extends Seeder
{
    public function run()
    {
        $tags = ['Teknologi', 'Web Development', 'Programming', 'AI', 'Blockchain'];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }
    }
}
