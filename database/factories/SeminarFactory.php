<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seminar>
 */
class SeminarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'name' => $this->faker->unique()->name(),
            'email' => $this->faker->unique()->email(),
            'nim' => $this->faker->name(),
            'college' => $this->faker->name(),
            'phone_number`' => $this->faker->name(),
            'type' => $this->faker->randomElement(['Online', 'Offline']),
            'proof' => 'https://source.unsplash.com/random/450×800/?payment',
            'isVerified' => rand(0, 1),
            'payment_method' => $this->faker->name(),

        ];
    }
}