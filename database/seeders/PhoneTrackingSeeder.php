<?php

namespace Database\Seeders;


use App\Models\Phonetracking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PhoneTrackingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Phonetracking::factory(10)->create();
    }
}
