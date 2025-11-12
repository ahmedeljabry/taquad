<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Events\Hourly\ContractPaused;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class PauseContractAction
{
    /**
     * Pause an active contract
     *
     * @param  Contract  $contract
     * @param  int  $userId  The user initiating the pause (client or freelancer)
     * @param  string|null  $reason
     * @return Contract
     */
    public function handle(Contract $contract, int $userId, ?string $reason = null): Contract
    {
        return DB::transaction(function () use ($contract, $userId, $reason) {
            // Verify the contract is active
            if ($contract->status !== ContractStatus::Active) {
                throw new \InvalidArgumentException('Only active contracts can be paused.');
            }

            // Verify the user has permission to pause
            if ($contract->client_id !== $userId && $contract->freelancer_id !== $userId) {
                throw new \InvalidArgumentException('You are not authorized to pause this contract.');
            }

            // Update contract status
            $contract->update([
                'status' => ContractStatus::Paused,
                'notes' => $reason ? "Paused: {$reason}" : 'Contract paused',
                'updated_by' => $userId,
            ]);

            // Dispatch event
            $contract->loadMissing(['project', 'client', 'freelancer']);
            event(new ContractPaused($contract, $userId, $reason));

            return $contract->fresh();
        });
    }
}

