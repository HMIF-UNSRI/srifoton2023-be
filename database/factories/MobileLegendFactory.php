<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MobileLegend>
 */
class MobileLegendFactory extends Factory
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

            // Anggota 1
            'name1' => $this->faker->name(),
            'nim1' => $this->faker->name(),
            'college1' => $this->faker->name(),
            'phone_number1' => $this->faker->name(),
            'instagram1' => $this->faker->name(),
            'id_mole1' => $this->faker->name(),
            'id_card1' => $this->faker->name(),
            // Anggota 2
            'name2' => $this->faker->name(),
            'nim2' => $this->faker->name(),
            'college2' => $this->faker->name(),
            'phone_number2' => $this->faker->name(),
            'instagram2' => $this->faker->name(),
            'id_mole2' => $this->faker->name(),
            'id_card2' => $this->faker->name(),
            // Anggota 3
            'name3' => $this->faker->name(),
            'nim3' => $this->faker->name(),
            'college3' => $this->faker->name(),
            'phone_number3' => $this->faker->name(),
            'instagram3' => $this->faker->name(),
            'id_mole3' => $this->faker->name(),
            'id_card3' => $this->faker->name(),
            // Anggota 4
            'name4' => $this->faker->name(),
            'nim4' => $this->faker->name(),
            'college4' => $this->faker->name(),
            'phone_number4' => $this->faker->name(),
            'instagram4' => $this->faker->name(),
            'id_mole4' => $this->faker->name(),
            'id_card4' => $this->faker->name(),
            // Anggota 5
            'name5' => $this->faker->name(),
            'nim5' => $this->faker->name(),
            'college5' => $this->faker->name(),
            'phone_number5' => $this->faker->name(),
            'instagram5' => $this->faker->name(),
            'id_mole5' => $this->faker->name(),
            'id_card5' => $this->faker->name(),
            // Anggota 6
            'name6' => $this->faker->name(),
            'nim6' => $this->faker->name(),
            'college6' => $this->faker->name(),
            'phone_number6' => $this->faker->name(),
            'instagram6' => $this->faker->name(),
            'id_mole6' => $this->faker->name(),
            'id_card6' => $this->faker->name(),

            // Payment
            'proof' => 'https://source.unsplash.com/random/450×800/?payment',
            'isVerified' => rand(0, 1),
            'payment_method' => $this->faker->name(),
        ];
    }
}
