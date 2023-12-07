<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Company::create([
        //     'owner_id' => 1,
        //     'name' => 'Walmart stores',
        //     'project_id' => '341c89fe-24f0-4265-8c1f-ba993b277d0c',
        //     'auth_token' => 'PT5815ba2ad1fdb4cbfd59c5a5fe5c308b721d373231757abc',
        //     'space_url' => 'riztheseowiz.signalwire.com'
        // ]);

        //neh
        DB::table('Companies')->insert([
            'owner_id' => 1,
            'name' => 'Walmart stores',
            'location' => 'Short St Bishop, California(CA), 93514',
            'lead_value' => 50
        ]);
    }
}
