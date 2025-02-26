<?php

namespace App\Console\Commands;

use App\Services\DataServices;
use Illuminate\Console\Command;

class getWhmcsData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-whmcs-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataService = new DataServices();
        $dataService->fetchAndInsertData();
    }
}
