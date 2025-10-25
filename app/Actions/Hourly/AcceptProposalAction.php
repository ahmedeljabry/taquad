<?php

namespace App\Actions\Hourly;

use App\Models\Contract;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;

class AcceptProposalAction
{
    public function handle(Proposal $proposal, int $clientId, int $weeklyLimitHours = 20): Contract
    {
        return DB::transaction(function () use ($proposal, $clientId, $weeklyLimitHours) {
            $proposal->update(['status' => 'accepted']);

            $contract = Contract::create([
                'project_id'        => $proposal->project_id,
                'client_id'         => $clientId,
                'freelancer_id'     => $proposal->freelancer_id,
                'type'              => 'hourly',
                'status'            => 'active',
                'hourly_rate'       => $proposal->hourly_rate,
                'weekly_limit_hours'=> $weeklyLimitHours,
                'started_at'        => now(),
            ]);

            return $contract;
        });
    }
}

