<?php

namespace App\Services\Tracker;

use App\Models\TrackerProject;
use App\Models\TrackerProjectMember;
use Illuminate\Support\Facades\DB;

class ProjectService
{
    public function create(array $attributes, array $members = []): TrackerProject
    {
        return DB::transaction(function () use ($attributes, $members) {
            /** @var TrackerProject $project */
            $project = TrackerProject::create($attributes);

            foreach ($members as $memberData) {
                $this->storeMember($project, $memberData);
            }

            return $project->load('members.user');
        });
    }

    public function update(TrackerProject $project, array $attributes): TrackerProject
    {
        return DB::transaction(function () use ($project, $attributes) {
            $project->fill($attributes);
            $project->save();

            return $project;
        });
    }

    public function storeMember(TrackerProject $project, array $data): TrackerProjectMember
    {
        $member = TrackerProjectMember::updateOrCreate(
            [
                'tracker_project_id' => $project->id,
                'user_id' => $data['user_id'],
            ],
            [
                'role' => $data['role'] ?? 'freelancer',
                'hourly_rate' => $data['hourly_rate'] ?? null,
                'weekly_limit_hours' => $data['weekly_limit_hours'] ?? null,
                'status' => $data['status'] ?? 'active',
                'invited_at' => $data['invited_at'] ?? now(),
                'joined_at' => $data['joined_at'] ?? now(),
                'added_by' => $data['added_by'] ?? null,
            ]
        );

        return $member->load('user');
    }

    public function removeMember(TrackerProjectMember $member): void
    {
        DB::transaction(function () use ($member) {
            $member->status = 'removed';
            $member->save();
        });
    }
}
