<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Token>
 */
class TokenFactory extends Factory
{
     protected static $sequenceNumber = 1000;
    private static $hashAlgorithms = ['sha256', 'sha512', 'ripemd160', 'whirlpool'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {   $type = $this->faker->randomElement(['API', 'Mobile', 'Web', 'System']);
         $algorithm = $this->faker->randomElement(self::$hashAlgorithms);
        return [
            'token_name' => $this->generateTokenNumber($type),
            "archived_at"=>$this->faker->randomElement([0,1])
        ];
    }
    protected function generateTokenNumber(string $type): string
    {
        $prefixMap = [
            'API' => 'API',
            'Mobile' => 'MOB',
            'Web' => 'WEB',
            'System' => 'SYS'
        ];
        $prefix = $prefixMap[$type] ?? 'TKN';
        return sprintf('%s-%s-%04d',
            $prefix,
            now()->format('ymd'),
            static::$sequenceNumber++
        );
    }

}
