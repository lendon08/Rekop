<?php

namespace Database\Factories;

use App\Enums\TrackingOptions;
use App\Enums\TrackingSearchEngine;
use App\Enums\TrackingTraffic;
use App\Models\Phonenumbers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PhoneTrackingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $trackingOption = $this->faker->randomElement(TrackingOptions::cases())->value;

        return [
            'phonenumbers_id' => Phonenumbers::factory()->create(),
            'display' => 0, //fake()->randomNumber(0,  1),
            'useon' => 0, //fake()->randomNumber(0,  1),
            'googleads' => 0, //fake()->randomNumber(0,  1),
            'tracking_options' => $trackingOption,
            'URL' => in_array($trackingOption, ['Landing Page', 'Web Referrals']) ? $this->faker->url() : null,
            'search_engine' => $trackingOption === 'Search' ? $this->faker->randomElement(TrackingSearchEngine::cases())->value : null,
            'traffic' => $trackingOption === 'Search' ? $this->faker->randomElement(TrackingTraffic::cases())->value : null,
            'swaptarget' => fake()->phoneNumber(),
            'callforwarding' => fake()->phoneNumber(),
            'numoftracking' => fake()->numberBetween(0, 6),
            'areacode' => fake()->numerify(),
            'poolname' => fake()->lexify('Pool ????'),
        ];
    }
}
