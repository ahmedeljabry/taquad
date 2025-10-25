<?php

namespace App\Actions\Hourly;

use App\Models\Contract;
use App\Models\TimeEntry;
use Illuminate\Support\Facades\DB;

class StopTimerAction
{
    public function handle(Contract $contract, int $userId): ?TimeEntry
    {
        if ($contract->freelancer_id !== $userId) {
            abort(403, 'Only freelancer can stop timer');
        }
        $entry = TimeEntry::where('contract_id', $contract->id)->whereNull('ended_at')->first();
        if (!$entry) {
            return null;
        }
        $entry->ended_at = now();
        $minutes = $entry->ended_at->diffInMinutes($entry->started_at);
        $entry->duration_minutes = max(0, $minutes);
        $entry->save();
        return $entry;
    }
}

