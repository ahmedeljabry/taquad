<?php

namespace App\Actions\Hourly;

use App\Enums\ProposalStatus;
use App\Events\Hourly\ProposalWithdrawn;
use App\Models\Proposal;
use Illuminate\Support\Facades\DB;

class WithdrawProposalAction
{
    /**
     * Withdraw a proposal
     *
     * @param  Proposal  $proposal
     * @param  int  $freelancerId
     * @return Proposal
     */
    public function handle(Proposal $proposal, int $freelancerId): Proposal
    {
        return DB::transaction(function () use ($proposal, $freelancerId) {
            // Verify the freelancer owns this proposal
            if ($proposal->freelancer_id !== $freelancerId) {
                throw new \InvalidArgumentException('You are not authorized to withdraw this proposal.');
            }

            // Verify the proposal is in a withdrawable state
            if ($proposal->status === ProposalStatus::Accepted || $proposal->status === ProposalStatus::Withdrawn) {
                throw new \InvalidArgumentException('This proposal cannot be withdrawn in its current state.');
            }

            // Update proposal status
            $proposal->update(['status' => ProposalStatus::Withdrawn]);

            // Dispatch event
            $proposal->loadMissing(['project', 'freelancer']);
            event(new ProposalWithdrawn($proposal));

            return $proposal->fresh();
        });
    }
}

