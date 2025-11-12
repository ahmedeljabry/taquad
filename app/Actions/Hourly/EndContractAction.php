<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Events\Hourly\ContractEnded;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class EndContractAction
{
    /**
     * End a contract
     *
     * @param  Contract  $contract
     * @param  int  $userId  The user initiating the end (client or freelancer)
     * @param  string  $reason
     * @param  array{leave_feedback?: bool}  $options
     * @return Contract
     */
    public function handle(Contract $contract, int $userId, string $reason, array $options = []): Contract
    {
        return DB::transaction(function () use ($contract, $userId, $reason, $options) {
            // Verify the contract can be ended
            if ($contract->status === ContractStatus::Ended) {
                throw new \InvalidArgumentException('This contract is already ended.');
            }

            // Verify the user has permission to end the contract
            if ($contract->client_id !== $userId && $contract->freelancer_id !== $userId) {
                throw new \InvalidArgumentException('You are not authorized to end this contract.');
            }

            // Update contract status
            $contract->update([
                'status' => ContractStatus::Ended,
                'ends_at' => now(),
                'notes' => "Ended: {$reason}",
                'updated_by' => $userId,
            ]);

            // Dispatch event
            $contract->loadMissing(['project', 'client', 'freelancer']);
            event(new ContractEnded($contract, $userId, $reason, $options));

            return $contract->fresh();
        });
    }
}

