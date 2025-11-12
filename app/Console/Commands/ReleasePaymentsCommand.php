<?php

namespace App\Console\Commands;

use App\Actions\Hourly\ReleasePaymentAction;
use App\Models\Payment;
use Illuminate\Console\Command;

class ReleasePaymentsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:release-payments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release payments to freelancers that have passed the hold period';

    /**
     * Execute the console command.
     */
    public function handle(ReleasePaymentAction $releaseAction): int
    {
        $this->info("Checking for payments ready to be released...");

        try {
            // Get payments that are completed but not yet released
            // and have passed the minimum hold period
            $holdDays = config('hourly.billing.funds_release_days', 3);
            $cutoffDate = now()->subDays($holdDays);

            $payments = Payment::query()
                ->where('status', 'completed')
                ->whereNull('released_at')
                ->where('paid_at', '<=', $cutoffDate)
                ->get();

            $count = 0;
            foreach ($payments as $payment) {
                try {
                    $releaseAction->handle($payment);
                    $count++;
                    $this->info("Released payment #{$payment->id} - \${$payment->freelancer_amount}");
                } catch (\Exception $e) {
                    $this->error("Failed to release payment #{$payment->id}: {$e->getMessage()}");
                }
            }
            
            $this->info("Successfully released {$count} payments.");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to release payments: {$e->getMessage()}");
            
            return Command::FAILURE;
        }
    }
}

