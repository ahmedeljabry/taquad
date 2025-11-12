<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Events\Hourly\OfferDeclined;
use App\Models\Contract;
use Illuminate\Support\Facades\DB;

class DeclineOfferAction
{
    /**
     * Decline a contract offer
     *
     * @param  Contract  $contract
     * @param  int  $freelancerId
     * @param  string|null  $reason
     * @return Contract
     */
    public function handle(Contract $contract, int $freelancerId, ?string $reason = null): Contract
    {
        return DB::transaction(function () use ($contract, $freelancerId, $reason) {
            // Verify the offer is in the correct state
            if ($contract->status !== ContractStatus::OfferSent) {
                throw new \InvalidArgumentException('Only offers in "offer_sent" status can be declined.');
            }

            // Verify the freelancer owns this offer
            if ($contract->freelancer_id !== $freelancerId) {
                throw new \InvalidArgumentException('You are not authorized to decline this offer.');
            }

            // Update contract to ended status
            $contract->update([
                'status' => ContractStatus::Ended,
                'ends_at' => now(),
                'notes' => $reason ? "Declined: {$reason}" : 'Declined by freelancer',
                'updated_by' => $freelancerId,
            ]);

            // Dispatch event
            $contract->loadMissing(['project', 'client', 'freelancer']);
            event(new OfferDeclined($contract, $reason));

            return $contract->fresh();
        });
    }
}

