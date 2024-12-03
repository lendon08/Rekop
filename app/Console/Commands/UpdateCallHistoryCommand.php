<?php

namespace App\Console\Commands;

use App\Integrations\SignalWire;
use App\Models\Callhistory;
use Illuminate\Console\Command;

class UpdateCallHistoryCommand extends Command
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

        $nextPageUrl = '/api/laml/2010-04-01/Accounts/' . env('SIGNALWIRE_PROJECTID') . '/Calls'; // Initial endpoint
        $this->info("fetching data...");
        do {
            // Fetch data from the API
            $data = SignalWire::http($nextPageUrl);

            if ($nextPageUrl) {
                // Loop through each call in the API response
                foreach ($data['calls'] as $call) {
                    // Check if the call record already exists in the database
                    $exists = Callhistory::where('id', $call['sid'])->exists();

                    // Exit the loop if a record already exists
                    if ($exists) {
                        $this->info('Fully updated. Stopping process.');
                        return;
                    }

                    // Save only if direction is inbound
                    if ($call['direction'] === 'inbound') {


                        Callhistory::create([
                            'id' => $call['sid'],
                            'phonenumber_id' => $call['phone_number_sid'],
                            'caller' => $call['formatted_from'],
                            'duration' => $call['duration'],
                            'price' => $call['price'],
                            'call_date' => $call['start_time'],
                            'recording' => $call['subresource_uris']['recordings'],
                            'status' => $call['status']
                        ]);
                    }
                }

                // Update to the next page URL if available
                $nextPageUrl = $data['next_page_uri'] ?? null;
            } else {
                $this->error('Failed to fetch data from API.');
                break;
            }
        } while ($nextPageUrl); // Continue fetching while there is a next_page_uri

        $this->info('Data fetching completed.');
    }
}
