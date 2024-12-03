<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;


class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Region::factory()->createMany([
            ['country' => 'us', 'code' => 'AL', 'name' => 'Alabama'],
            ['country' => 'us', 'code' => 'AK', 'name' => 'Alaska'],
            ['country' => 'us', 'code' => 'AZ', 'name' => 'Arizona'],
            ['country' => 'us', 'code' => 'AR', 'name' => 'Arkansas'],
            ['country' => 'us', 'code' => 'CA', 'name' => 'California'],
            ['country' => 'us', 'code' => 'CO', 'name' => 'Colorado'],
            ['country' => 'us', 'code' => 'CT', 'name' => 'Connecticut'],
            ['country' => 'us', 'code' => 'DE', 'name' => 'Delaware'],
            ['country' => 'us', 'code' => 'FL', 'name' => 'Florida'],
            ['country' => 'us', 'code' => 'GA', 'name' => 'Georgia'],
            ['country' => 'us', 'code' => 'HI', 'name' => 'Hawaii'],
            ['country' => 'us', 'code' => 'ID', 'name' => 'Idaho'],
            ['country' => 'us', 'code' => 'IL', 'name' => 'Illinois'],
            ['country' => 'us', 'code' => 'IN', 'name' => 'Indiana'],
            ['country' => 'us', 'code' => 'IA', 'name' => 'Iowa'],
            ['country' => 'us', 'code' => 'KS', 'name' => 'Kansas'],
            ['country' => 'us', 'code' => 'KY', 'name' => 'Kentucky'],
            ['country' => 'us', 'code' => 'LA', 'name' => 'Louisiana'],
            ['country' => 'us', 'code' => 'ME', 'name' => 'Maine'],
            ['country' => 'us', 'code' => 'MD', 'name' => 'Maryland'],
            ['country' => 'us', 'code' => 'MA', 'name' => 'Massachusetts'],
            ['country' => 'us', 'code' => 'MI', 'name' => 'Michigan'],
            ['country' => 'us', 'code' => 'MN', 'name' => 'Minnesota'],
            ['country' => 'us', 'code' => 'MS', 'name' => 'Mississippi'],
            ['country' => 'us', 'code' => 'MO', 'name' => 'Missouri'],
            ['country' => 'us', 'code' => 'MT', 'name' => 'Montana'],
            ['country' => 'us', 'code' => 'NE', 'name' => 'Nebraska'],
            ['country' => 'us', 'code' => 'NV', 'name' => 'Nevada'],
            ['country' => 'us', 'code' => 'NH', 'name' => 'New Hampshire'],
            ['country' => 'us', 'code' => 'NJ', 'name' => 'New Jersey'],
            ['country' => 'us', 'code' => 'NM', 'name' => 'New Mexico'],
            ['country' => 'us', 'code' => 'NY', 'name' => 'New York'],
            ['country' => 'us', 'code' => 'NC', 'name' => 'North Carolina'],
            ['country' => 'us', 'code' => 'ND', 'name' => 'North Dakota'],
            ['country' => 'us', 'code' => 'OH', 'name' => 'Ohio'],
            ['country' => 'us', 'code' => 'OK', 'name' => 'Oklahoma'],
            ['country' => 'us', 'code' => 'OR', 'name' => 'Oregon'],
            ['country' => 'us', 'code' => 'PA', 'name' => 'Pennsylvania'],
            ['country' => 'us', 'code' => 'RI', 'name' => 'Rhode Island'],
            ['country' => 'us', 'code' => 'SC', 'name' => 'South Carolina'],
            ['country' => 'us', 'code' => 'SD', 'name' => 'South Dakota'],
            ['country' => 'us', 'code' => 'TN', 'name' => 'Tennessee'],
            ['country' => 'us', 'code' => 'TX', 'name' => 'Texas'],
            ['country' => 'us', 'code' => 'UT', 'name' => 'Utah'],
            ['country' => 'us', 'code' => 'VT', 'name' => 'Vermont'],
            ['country' => 'us', 'code' => 'VA', 'name' => 'Virginia'],
            ['country' => 'us', 'code' => 'WA', 'name' => 'Washington'],
            ['country' => 'us', 'code' => 'WV', 'name' => 'West Virginia'],
            ['country' => 'us', 'code' => 'WI', 'name' => 'Wisconsin'],
            ['country' => 'us', 'code' => 'WY', 'name' => 'Wyoming'],
            ['country' => 'canada', 'code' => 'AB', 'name' => 'Alberta'],
            ['country' => 'canada', 'code' => 'BC', 'name' => 'British Columbia	'],
            ['country' => 'canada', 'code' => 'MB', 'name' => 'Manitoba'],
            ['country' => 'canada', 'code' => 'NB', 'name' => 'New Brunswick'],
            ['country' => 'canada', 'code' => 'NL', 'name' => 'Newfoundland and Labrador'],
            ['country' => 'canada', 'code' => 'NS', 'name' => 'Nova Scotia'],
            ['country' => 'canada', 'code' => 'NT', 'name' => 'Northwest Territories'],
            ['country' => 'canada', 'code' => 'NU', 'name' => 'Nunavut'],
            ['country' => 'canada', 'code' => 'ON', 'name' => 'Ontario'],
            ['country' => 'canada', 'code' => 'PE', 'name' => 'Prince Edward Island'],
            ['country' => 'canada', 'code' => 'QC', 'name' => 'Quebec'],
            ['country' => 'canada', 'code' => 'SK', 'name' => 'Saskatchewan'],
            ['country' => 'canada', 'code' => 'YT', 'name' => 'Yukon'],
        ]);
    }
}
