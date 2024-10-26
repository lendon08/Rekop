<?php

namespace App\Console\Commands;

use App\Integrations\SignalWire;
use Illuminate\Console\Command;

class UpdateCallHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:call-history';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch paginated data from API and store in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nextPageUrl = 'https://example.com/api/data?page=1'; // Initial API endpoint

        do {
            // Fetch the data from the API
            $response = Http::get($nextPageUrl);

            if ($response->successful()) {
                $data = $response->json();

                // Store the data in the database
                foreach ($data['data'] as $item) {
                    YourModel::create([
                        // Map the fields from the API response to your database columns
                        'field1' => $item['field1'],
                        'field2' => $item['field2'],
                        // Add all fields accordingly
                    ]);
                }

                // Check for the next page URI
                $nextPageUrl = $data['next_page_uri'] ?? null;
            } else {
                $this->error('Failed to fetch data from API.');
                break;
            }
        } while ($nextPageUrl); // Continue fetching while there is a next_page_uri

        $this->info('Data fetching completed.');
    }
}
