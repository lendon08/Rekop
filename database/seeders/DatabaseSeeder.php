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

        // \App\Models\Company::create([
        //     'user_id' => 1,
        //     'name' => 'Walmart stores',
        //     'project_id' => '341c89fe-24f0-4265-8c1f-ba993b277d0c',
        //     'auth_token' => 'PT5815ba2ad1fdb4cbfd59c5a5fe5c308b721d373231757abc',
        //     'space_url' => 'riztheseowiz.signalwire.com'
        // ]);

        User::factory()->create([
            'email' => "sample@gmail.com",
            'password' => Hash::make("watercannon"),
            'email_verified_at' => now(),
        ]);

        Company::factory()->create();
        $this->call(RegionSeeder::class);
    }
}
