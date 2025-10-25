<?php

namespace App\Actions\Hourly;

use App\Models\Contract;
use App\Models\Invoice;
use App\Models\TimeEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateWeeklyInvoicesAction
{
    public function handle(?Carbon $forWeekEnding = null): int
    {
        $end = ($forWeekEnding ?: now()->startOfWeek()->subSecond())->copy()->endOfWeek();
        $start = $end->copy()->startOfWeek();

        $count = 0;
        $contracts = Contract::where('status', 'active')->get();
        foreach ($contracts as $contract) {
            $minutes = TimeEntry::where('contract_id', $contract->id)
                ->whereBetween('started_at', [$start, $end])
                ->sum('duration_minutes');

            if ($minutes <= 0) { continue; }

            $amount = ($minutes / 60) * (float) $contract->hourly_rate;
            Invoice::updateOrCreate([
                'contract_id'     => $contract->id,
                'week_start_date' => $start->toDateString(),
                'week_end_date'   => $end->toDateString(),
            ], [
                'total_minutes'   => $minutes,
                'total_amount'    => round($amount, 2),
                'status'          => 'open',
            ]);
            $count++;
        }
        return $count;
    }
}

