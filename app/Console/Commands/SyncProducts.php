<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Services\SyncProductsService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class SyncProducts extends Command
{
    private SyncProductsService $syncService;

    public function __construct()
    {
        parent::__construct();
        $this->syncService = new SyncProductsService();
    }

    protected $signature = 'sync:products';
    protected $description = 'This command is responsible for getting the products from supliers every day and sync them to database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::debug('Syncing products - START - BRAZILIAN PROVIDER');
        $this->syncService->syncBrazilianProvider();

        Log::debug('Syncing products - START - EUROPEAN PROVIDER');
        $this->syncService->syncEuropeanProvider();
        return Command::SUCCESS;
    }
}
