<?php

namespace App\Actions\Hourly;

use App\Enums\ContractStatus;
use App\Models\Contract;
use App\Models\ProjectBid;
use App\Models\TrackerProjectMember;
use App\Services\Tracker\ContractService;
use App\Services\Tracker\HourlyProjectProvisioner;
use Illuminate\Support\Facades\DB;

class AcceptProposalAction
{
    public function __construct(
        private readonly ContractService $contracts,
        private readonly HourlyProjectProvisioner $provisioner
    ) {
    }

    /**
     * @param  array{weekly_limit_hours?: int|float|null, allow_manual_time?: bool|null, auto_approve_low_activity?: bool|null, hourly_rate?: float|null}  $options
     */
    public function handle(ProjectBid $bid, array $options = []): Contract
    {
        return DB::transaction(function () use ($bid, $options) {
            $bid->loadMissing(['project.trackerProject', 'project.client']);

            $project = $bid->project;
            if (! $project) {
                throw new \RuntimeException('Project bid does not have an associated project.');
            }

            $trackerProject = $project->trackerProject;
            if (! $trackerProject) {
                $trackerProject = $this->provisioner->provision($project, [
                    'weekly_limit_hours' => $options['weekly_limit_hours'] ?? null,
                    'allow_manual_time' => $options['allow_manual_time'] ?? false,
                    'auto_approve_low_activity' => $options['auto_approve_low_activity'] ?? false,
                    'default_hourly_rate' => $options['hourly_rate'] ?? null,
                ]);
            }

            $weeklyLimit = $options['weekly_limit_hours'] ?? $trackerProject->weekly_limit_hours ?? 40;
            $allowManualTime = (bool) ($options['allow_manual_time'] ?? $trackerProject->allow_manual_time_default);
            $autoApproveLowActivity = (bool) ($options['auto_approve_low_activity'] ?? $trackerProject->auto_approve_low_activity_default);

            $currency = settings('currency');
            $currencyCode = $currency?->code ?? 'USD';

            $hourlyRate = $options['hourly_rate'] ?? (float) convertToNumber($bid->amount ?? 0);

            $existingContract = Contract::query()
                ->where('project_id', $project->id)
                ->where('freelancer_id', $bid->user_id)
                ->whereIn('status', [
                    ContractStatus::OfferSent->value,
                    ContractStatus::Active->value,
                    ContractStatus::Paused->value,
                ])
                ->first();

            if ($existingContract) {
                $existingContract->update([
                    'project_id'               => $project->id,
                    'hourly_rate'               => $hourlyRate,
                    'weekly_limit_hours'        => $weeklyLimit,
                    'allow_manual_time'         => $allowManualTime,
                    'auto_approve_low_activity' => $autoApproveLowActivity,
                    'status'                    => ContractStatus::Active,
                    'tracker_project_id'        => $trackerProject->id,
                ]);

                return $existingContract->fresh();
            }

            $contract = $this->contracts->create([
                'tracker_project_id'        => $trackerProject->id,
                'project_id'                => $project->id,
                'client_id'                 => $project->user_id,
                'freelancer_id'             => $bid->user_id,
                'type'                      => 'hourly',
                'status'                    => ContractStatus::Active,
                'hourly_rate'               => $hourlyRate,
                'weekly_limit_hours'        => $weeklyLimit,
                'allow_manual_time'         => $allowManualTime,
                'auto_approve_low_activity' => $autoApproveLowActivity,
                'currency_code'             => $currencyCode,
                'starts_at'                 => now(),
                'created_by'                => $project->user_id,
            ]);

            TrackerProjectMember::updateOrCreate(
                [
                    'tracker_project_id' => $trackerProject->id,
                    'user_id'            => $bid->user_id,
                ],
                [
                    'role'               => 'freelancer',
                    'status'             => 'active',
                    'hourly_rate'        => $hourlyRate,
                    'weekly_limit_hours' => $weeklyLimit,
                    'invited_at'         => now(),
                    'joined_at'          => now(),
                    'added_by'           => $project->user_id,
                ]
            );

            return $contract;
        });
    }
}
