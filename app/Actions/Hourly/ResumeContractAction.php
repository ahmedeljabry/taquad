<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Events\Hourly\ContractResumed;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class ResumeContractAction
{
    /**
     * Resume a paused contract
     *
     * @param  Contract  $contract
     * @param  int  $userId  The user initiating the resume (client or freelancer)
     * @return Contract
     */
    public function handle(Contract $contract, int $userId): Contract
    {
        return DB::transaction(function () use ($contract, $userId) {
            // Verify the contract is paused
            if ($contract->status !== ContractStatus::Paused) {
                throw new \InvalidArgumentException('Only paused contracts can be resumed.');
            }

            // Verify the user has permission to resume
            if ($contract->client_id !== $userId && $contract->freelancer_id !== $userId) {
                throw new \InvalidArgumentException('You are not authorized to resume this contract.');
            }

            // Update contract status
            $contract->update([
                'status' => ContractStatus::Active,
                'notes' => 'Contract resumed',
                'updated_by' => $userId,
            ]);

            // Dispatch event
            $contract->loadMissing(['project', 'client', 'freelancer']);
            event(new ContractResumed($contract, $userId));

            return $contract->fresh();
        });
    }
}

