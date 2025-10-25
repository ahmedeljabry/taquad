<?php

namespace App\Console\Commands;

use App\Actions\Hourly\GenerateWeeklyInvoicesAction;
use Illuminate\Console\Command;

class GenerateWeeklyInvoices extends Command
{
    protected $signature = 'hourly:generate-weekly-invoices';
    protected $description = 'Generate hourly invoices for prior week';

    public function handle(GenerateWeeklyInvoicesAction $action): int
    {
        $count = $action->handle();
        $this->info("Generated/updated {$count} weekly invoices.");
        return Command::SUCCESS;
    }
}

