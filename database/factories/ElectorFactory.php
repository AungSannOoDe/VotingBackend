<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Elector>
 */
class ElectorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'elector_name' => $this->faker->name(),
            'phone'        => $this->faker->phoneNumber(),
            'address'      => $this->faker->address(),
            'gender'       => $this->faker->randomElement(['male', 'female']),
            'Years'        => $this->faker->randomElement(['Freshman', 'Sophomore', 'Junior', 'Senior']),
            'won_status'   => $this->faker->randomElement([0,1,2])
        ];
    }
}
