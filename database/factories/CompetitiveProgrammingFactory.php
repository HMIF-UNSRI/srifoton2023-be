<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompetitiveProgramming>
 */
class CompetitiveProgrammingFactory extends Factory
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
            'team_name' => $this->faker->unique()->name(),
            'email' => $this->faker->unique()->email(),
            'college' => $this->faker->name(),

            // Anggota 1
            'name1' => $this->faker->name(),
            'nim1' => $this->faker->name(),
            'phone_number1' => $this->faker->name(),
            'instagram1' => $this->faker->name(),
            'id_card1' => 'https://source.unsplash.com/random/450×800/?card',
            // Anggota 2
            'name2' => $this->faker->name(),
            'nim2' => $this->faker->name(),
            'phone_number2' => $this->faker->name(),
            'instagram2' => $this->faker->name(),
            'id_card2' => 'https://source.unsplash.com/random/450×800/?card',
            // Anggota 3
            'name3' => $this->faker->name(),
            'nim3' => $this->faker->name(),
            'phone_number3' => $this->faker->name(),
            'instagram3' => $this->faker->name(),
            'id_card3' => 'https://source.unsplash.com/random/450×800/?card',

            // Payment
            'proof' => 'https://source.unsplash.com/random/450×800/?payment',
            'isVerified' => rand(0, 1),
            'payment_method' => $this->faker->name(),
        ];
    }
}
