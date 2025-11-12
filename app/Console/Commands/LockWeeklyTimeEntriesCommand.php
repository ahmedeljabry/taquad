<?php

namespace App\Console\Commands;

use App\Services\Hourly\SegmentReviewService;
use Carbon\CarbonImmutable;
use Illuminate\Console\Command;

class LockWeeklyTimeEntriesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hourly:lock-entries 
                            {--now= : Current time (YYYY-MM-DD HH:MM:SS), defaults to now}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lock time entries from previous week that are past review period';

    /**
     * Execute the console command.
     */
    public function handle(SegmentReviewService $reviewService): int
    {
        $now = $this->option('now') 
            ? CarbonImmutable::parse($this->option('now'))
            : CarbonImmutable::now();

        $this->info("Locking time entries as of: {$now->format('Y-m-d H:i:s')}");

        try {
            $count = $reviewService->lockPreviousWeek($now);
            
            $this->info("Successfully locked {$count} time entries.");
            
            return Command::SUCCESS;
        } catch (\Exception $e) {
            $this->error("Failed to lock time entries: {$e->getMessage()}");
            
            return Command::FAILURE;
        }
    }
}

