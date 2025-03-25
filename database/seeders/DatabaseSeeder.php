<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use App\Models\Phonenumbers;
use App\Integrations\SignalWire;
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
        }

        $this->call([
            RegionSeeder::class,
            // PhoneTrackingSeeder::class,
        ]);
    }
}
