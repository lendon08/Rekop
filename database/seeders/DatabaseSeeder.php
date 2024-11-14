<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Testing\Fakes\Fake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {


        Company::factory(10)->create();
        User::factory()->create();


        $this->call([
            RegionSeeder::class,
            // PhoneTrackingSeeder::class,
        ]);
    }
}
