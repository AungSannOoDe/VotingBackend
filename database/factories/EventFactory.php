<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'event_name' => $this->faker->sentence,
            'event_participant' =>$this->faker-> randomElement(["Alice", "Johnson","David Lee","Emma Wilson","Michael Brown","Sophia Nguyen","Daniel Kim","Olivia Davis","William Martinez","Isabella Thomas","James Anderson"]),
            'event_start_time' => $this->faker->dateTimeBetween('now', '+1 month'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
