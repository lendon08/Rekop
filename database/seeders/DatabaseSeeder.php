<?php

namespace Database\Seeders;

use App\Enums\TrackingOptions;
use App\Enums\TrackingSearchEngine;
use App\Enums\TrackingTraffic;
use App\Models\Company;
use App\Models\User;
use App\Models\Phonenumbers;
use App\Integrations\SignalWire;
use App\Models\Phonetracking;
use Illuminate\Database\Seeder;
use App\Services\PhoneFormatService;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Company::factory(10)->create();
        User::factory()->create();


        $phoneNumbers = SignalWire::http('/api/relay/rest/phone_numbers');

        $trackingOption = fake()->randomElement(TrackingOptions::cases())->value;

        foreach ($phoneNumbers['data'] as $phoneNumber) {
            if (Phonenumbers::where('id', $phoneNumber['id'])->exists()) {
                continue;
            }

            Phonenumbers::create([
                'id' => $phoneNumber['id'],
                'name' => $phoneNumber['name'],
                'number' => PhoneFormatService::format($phoneNumber['number']),
                'company_id' => 1,
            ]);

            Phonetracking::create([
                'phonenumber_id' => $phoneNumber['id'],
                'display' => 0, //fake()->randomNumber(0,  1),
                'useon' => 0, //fake()->randomNumber(0,  1),
                'googleads' => 0, //fake()->randomNumber(0,  1),
                'utm_source' => 'offline',
                'utm_medium' => 'direct',
                'utm_campaign' => 'campaign',
                'tracking_options' => $trackingOption,
                'URL' => in_array($trackingOption, ['Landing Page', 'Web Referrals']) ? fake()->url() : null,
                'search_engine' => $trackingOption === 'Search' ? fake()->randomElement(TrackingSearchEngine::cases())->value : null,
                'traffic' => $trackingOption === 'Search' ? fake()->randomElement(TrackingTraffic::cases())->value : null,
                'swaptarget' => fake()->phoneNumber(),
                'callforwarding' => fake()->phoneNumber(),
                'whispermsg' => fake()->sentence(),
                'recordingflag' => true,
                'textmsg' => false,
                'callgreeting' => fake()->phoneNumber(),
                'campaignname' => fake()->word(),
                'autoreply' => false,
                'numoftracking' => fake()->numberBetween(0, 6),
                'areacode' => fake()->numerify(),
                'poolname' => fake()->lexify('Pool ????'),
            ]);
        }

        $this->call([
            RegionSeeder::class,
            // PhoneTrackingSeeder::class,
        ]);
    }
}
