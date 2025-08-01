<?php

namespace Database\Factories;

use App\Models\Token;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voter>
 */
class VoterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tokenId=Token::pluck('id')->toArray();
        return [
            'voter_name' => $this->faker->name(),
            'voter_email' => $this->faker->unique()->safeEmail(),
            'Major'=>$this->faker->randomElement(["CS","CT"]),
            'Years'=>$this->faker->randomElement(["fresher","Second year","third year","fourth year"]),
            'roll_name' => strtoupper(Str::random(2)) . $this->faker->numberBetween(1000, 9999),
            'voter_password' => Hash::make('password'),
            'profile_image' => $this->faker->imageUrl(200, 200, 'people'),
        ];
    }
}
