<?php

namespace App\Actions\Hourly;

use App\Models\Contract;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\DB;

class StartTimerAction
{
    public function handle(Contract $contract, int $userId): TimeEntry
    {
        if ($contract->status->value !== 'active') {
            abort(403, 'Contract is not active');
        }
        if ($contract->freelancer_id !== $userId) {
            abort(403, 'Only freelancer can start timer');
        }

        // Prevent overlapping running entry
        $running = TimeEntry::where('contract_id', $contract->id)->whereNull('ended_at')->first();
        if ($running) {
            return $running;
        }

        return TimeEntry::create([
            'contract_id' => $contract->id,
            'started_at'  => now(),
        ]);
    }
}

