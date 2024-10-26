<?php

namespace Database\Factories;

use App\Models\Callhistory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Callhistory>
 */
class CallhistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => fake()->uuid(),
            'caller' => fake()->phoneNumber(),
            'receiver' => fake()->phoneNumber(),
            'duration' => fake()->randomNumber(2, true),
            'price' => fake()->randomFloat(5, 0.00001, 0.01),
            'call_date' => fake()->dateTime(),
            'recording' => fake()->url()
        ];
    }
}
