<?php

namespace Database\Factories;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition(): array
    {
        return [
            'phone_number' => $this->faker->phoneNumber(),
            'user_id' => User::factory(), // Menghubungkan ke user secara otomatis
        ];
    }
}
