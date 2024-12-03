<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Integrations\SignalWire;
use Illuminate\Support\Facades\DB;

class CreateCronCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forwarding:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Signalwire Phones call request';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $scheds = json_decode(DB::table('phonenumbers')
            ->select('name', 'id', 'call_request_url')
            ->where('start_sched', date('H:i'))
            ->get());

        // ->where('start_sched', '08:00')

        if (count($scheds) > 0) {
            foreach ($scheds as $sched) {
                SignalWire::updateForwarding("/api/relay/rest/phone_numbers/" . $sched->id, $sched->call_request_url);
                info('UPDATED: ' . $sched->name . ', TIME: ' . date('H:i'));
            }
        }

        return Command::SUCCESS;
    }
}
