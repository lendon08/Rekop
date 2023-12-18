<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateCallForwardingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Update:Callforwarding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Call Forwarding';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
