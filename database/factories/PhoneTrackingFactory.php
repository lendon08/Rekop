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
            'phonenumber_id' => Phonenumbers::inRandomOrder()->value('id'),
            'display' => 0, //fake()->randomNumber(0,  1),
            'useon' => 0, //fake()->randomNumber(0,  1),
            'googleads' => 0, //fake()->randomNumber(0,  1),
            'utm_source' => 'offline',
            'utm_medium' => 'direct',
            'utm_campaign' => 'campaign',
            'tracking_options' => $trackingOption,
            'URL' => in_array($trackingOption, ['Landing Page', 'Web Referrals']) ? $this->faker->url() : null,
            'search_engine' => $trackingOption === 'Search' ? $this->faker->randomElement(TrackingSearchEngine::cases())->value : null,
            'traffic' => $trackingOption === 'Search' ? $this->faker->randomElement(TrackingTraffic::cases())->value : null,
            'swaptarget' => fake()->phoneNumber(),
            'callforwarding' => fake()->phoneNumber(),
            'whispermsg' => fake()->paragraph(),
            'recordingflag' => true,
            'textmsg' => false,
            'callgreeting' => fake()->phoneNumber(),
            'campaignname' => fake()->word(),
            'autoreply' => false,
            'numoftracking' => fake()->numberBetween(0, 6),
            'areacode' => fake()->numerify(),
            'poolname' => fake()->lexify('Pool ????'),
        ];
    }
}
