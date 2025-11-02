<?php

namespace App\Services\Tracker;

use App\Models\Project;
use App\Models\TrackerClient;
use App\Models\TrackerProject;
use App\Models\TrackerProjectMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HourlyProjectProvisioner
{
    /**
     * Provision tracker records for a newly created hourly project.
     *
     * @param  Project  $project
     * @param  array<string, mixed>  $options
     */
    public function provision(Project $project, array $options = []): TrackerProject
    {
        return DB::transaction(function () use ($project, $options) {
            $clientUser = $project->client;

            $trackerClient = TrackerClient::firstOrCreate(
                ['user_id' => $project->user_id],
                [
                    'name'             => $clientUser?->fullname ?? $clientUser?->username ?? __('messages.t_tracker_default_client_name', ['id' => $project->user_id]),
                    'company_name'     => null,
                    'contact_email'    => $clientUser?->email,
                    'contact_phone'    => null,
                    'timezone'         => $clientUser?->timezone ?? config('app.timezone'),
                    'currency_code'    => $options['currency_code'] ?? settings('currency')->code ?? 'USD',
                    'billing_preferences' => null,
                    'notes'            => null,
                ]
            );

            $defaultHourlyRate = $options['default_hourly_rate'] ?? null;
            $weeklyLimit = $options['weekly_limit_hours'] ?? null;

            $trackerProject = TrackerProject::updateOrCreate(
                ['project_id' => $project->id],
                [
                    'tracker_client_id'                   => $trackerClient->id,
                    'created_by'                          => $project->user_id,
                    'name'                                => $project->title,
                    'reference_code'                      => $project->pid,
                    'description'                         => Str::limit(strip_tags($project->description), 600),
                    'default_hourly_rate'                 => $defaultHourlyRate,
                    'weekly_limit_hours'                  => $weeklyLimit,
                    'allow_manual_time_default'           => (bool) ($options['allow_manual_time'] ?? false),
                    'auto_approve_low_activity_default'   => (bool) ($options['auto_approve_low_activity'] ?? false),
                    'is_active'                           => true,
                    'starts_at'                           => $options['starts_at'] ?? now(),
                    'archived_at'                         => null,
                ]
            );

            if ($clientUser) {
                TrackerProjectMember::updateOrCreate(
                    [
                        'tracker_project_id' => $trackerProject->id,
                        'user_id'            => $clientUser->id,
                    ],
                    [
                        'role'                => 'manager',
                        'status'              => 'active',
                        'hourly_rate'         => null,
                        'weekly_limit_hours'  => $weeklyLimit,
                        'invited_at'          => $trackerProject->created_at ?? now(),
                        'joined_at'           => now(),
                        'added_by'            => $clientUser->id,
                    ]
                );
            }

            return $trackerProject;
        });
    }
}
