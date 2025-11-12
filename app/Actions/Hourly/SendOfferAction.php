<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Enums\ProposalStatus;
use App\Events\Hourly\OfferSent;
use App\Models\Contract;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\User;
use App\Services\Tracker\ContractService;
use App\Services\Tracker\HourlyProjectProvisioner;
use Illuminate\Support\Facades\DB;

class SendOfferAction
{
    public function __construct(
        private readonly ContractService $contracts,
        private readonly HourlyProjectProvisioner $provisioner
    ) {
    }

    /**
     * Send an offer to a freelancer for an hourly project
     *
     * @param  Project  $project
     * @param  User  $freelancer
     * @param  array{hourly_rate: float, weekly_limit_hours?: float, allow_manual_time?: bool, auto_approve_low_activity?: bool, message?: string, proposal_id?: int}  $options
     * @return Contract
     */
    public function handle(Project $project, User $freelancer, array $options): Contract
    {
        return DB::transaction(function () use ($project, $freelancer, $options) {
            $project->loadMissing(['trackerProject', 'client']);

            // Provision tracker project if not exists
            $trackerProject = $project->trackerProject;
            if (!$trackerProject) {
                $trackerProject = $this->provisioner->provision($project, [
                    'weekly_limit_hours' => $options['weekly_limit_hours'] ?? 40,
                    'allow_manual_time' => $options['allow_manual_time'] ?? false,
                    'auto_approve_low_activity' => $options['auto_approve_low_activity'] ?? false,
                    'default_hourly_rate' => $options['hourly_rate'],
                ]);
            }

            $currency = settings('currency');
            $currencyCode = $currency?->code ?? 'USD';

            // Check if there's already an active offer or contract
            $existingContract = Contract::query()
                ->where('project_id', $project->id)
                ->where('freelancer_id', $freelancer->id)
                ->whereIn('status', [
                    ContractStatus::OfferSent->value,
                    ContractStatus::Active->value,
                    ContractStatus::Paused->value,
                ])
                ->first();

            if ($existingContract) {
                // Update existing offer
                $existingContract->update([
                    'hourly_rate' => $options['hourly_rate'],
                    'weekly_limit_hours' => $options['weekly_limit_hours'] ?? 40,
                    'allow_manual_time' => $options['allow_manual_time'] ?? false,
                    'auto_approve_low_activity' => $options['auto_approve_low_activity'] ?? false,
                    'notes' => $options['message'] ?? null,
                    'updated_by' => $project->user_id,
                ]);

                return $existingContract->fresh();
            }

            // Create new contract offer
            $contract = $this->contracts->create([
                'tracker_project_id' => $trackerProject->id,
                'project_id' => $project->id,
                'client_id' => $project->user_id,
                'freelancer_id' => $freelancer->id,
                'type' => 'hourly',
                'status' => ContractStatus::OfferSent,
                'hourly_rate' => $options['hourly_rate'],
                'weekly_limit_hours' => $options['weekly_limit_hours'] ?? 40,
                'allow_manual_time' => $options['allow_manual_time'] ?? false,
                'auto_approve_low_activity' => $options['auto_approve_low_activity'] ?? false,
                'currency_code' => $currencyCode,
                'notes' => $options['message'] ?? null,
                'created_by' => $project->user_id,
            ]);

            // If this is based on a proposal, update the proposal status
            if (isset($options['proposal_id'])) {
                $proposal = Proposal::find($options['proposal_id']);
                if ($proposal && $proposal->status !== ProposalStatus::Accepted) {
                    $proposal->update(['status' => ProposalStatus::Accepted]);
                }
            }

            // Dispatch event
            event(new OfferSent($contract, $project, $freelancer));

            return $contract;
        });
    }
}

