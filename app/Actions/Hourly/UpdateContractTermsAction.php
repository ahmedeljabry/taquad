<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Events\Hourly\ContractTermsUpdated;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class UpdateContractTermsAction
{
    /**
     * Update contract terms (rate, weekly limit, etc.)
     *
     * @param  Contract  $contract
     * @param  int  $clientId  Only clients can update contract terms
     * @param  array{hourly_rate?: float, weekly_limit_hours?: float, allow_manual_time?: bool, auto_approve_low_activity?: bool}  $updates
     * @return Contract
     */
    public function handle(Contract $contract, int $clientId, array $updates): Contract
    {
        return DB::transaction(function () use ($contract, $clientId, $updates) {
            // Verify the contract is active or paused
            if (!in_array($contract->status, [ContractStatus::Active, ContractStatus::Paused])) {
                throw new \InvalidArgumentException('Only active or paused contracts can have their terms updated.');
            }

            // Verify the user is the client
            if ($contract->client_id !== $clientId) {
                throw new \InvalidArgumentException('Only the client can update contract terms.');
            }

            // Filter out null values
            $updates = array_filter($updates, fn($value) => $value !== null);
            
            if (empty($updates)) {
                return $contract;
            }

            // Update contract
            $updates['updated_by'] = $clientId;
            $contract->update($updates);

            // Dispatch event
            $contract->loadMissing(['project', 'client', 'freelancer']);
            event(new ContractTermsUpdated($contract, $updates));

            return $contract->fresh();
        });
    }
}

