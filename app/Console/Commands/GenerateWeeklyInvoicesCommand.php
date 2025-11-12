<?php

namespace App\Console\Commands;

use App\Services\Hourly\InvoiceService;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class GenerateWeeklyInvoicesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:generate-invoices 
                            {--week= : Week ending date (YYYY-MM-DD), defaults to last week}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate weekly invoices for all active hourly contracts';

    /**
     * Execute the console command.
     */
    public function handle(InvoiceService $invoiceService): int
    {
        $weekEnding = $this->option('week') 
            ? CarbonImmutable::parse($this->option('week'))->endOfWeek()
            : CarbonImmutable::now()->subWeek()->endOfWeek();

        $this->info("Generating invoices for week ending: {$weekEnding->format('Y-m-d')}");

        try {
            $count = $invoiceService->generateWeeklyInvoices($weekEnding);
            
            $this->info("Successfully generated {$count} invoices.");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to generate invoices: {$e->getMessage()}");
            
            return Command::FAILURE;
        }
    }
}

