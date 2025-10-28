<?php

namespace App\Services;

use App\Models\{Project,ProjectLevel,ProjectReview,User};

final class ProjectReputationService
{
    public static function refreshFor(User $user): void
    {
        [$freelancerStats, $clientStats] = self::collectStats($user);

        $user->forceFill([
            'project_rating_count' => $freelancerStats['count'],
            'project_rating_sum'   => $freelancerStats['sum'],
            'project_rating_avg'   => $freelancerStats['avg'],
            'client_rating_count'  => $clientStats['count'],
            'client_rating_sum'    => $clientStats['sum'],
            'client_rating_avg'    => $clientStats['avg'],
            'last_project_review_at' => now(),
        ])->save();

        self::assignLevel($user, 'seller', $freelancerStats);
        self::assignLevel($user, 'buyer', $clientStats);
    }

    protected static function collectStats(User $user): array
    {
        $freelancerQuery = ProjectReview::query()
            ->where('reviewee_id', $user->id)
            ->where('reviewer_role', 'client')
            ->where('is_skipped', false)
            ->whereNotNull('score');

        $clientQuery = ProjectReview::query()
            ->where('reviewee_id', $user->id)
            ->where('reviewer_role', 'freelancer')
            ->where('is_skipped', false)
            ->whereNotNull('score');

        $freelancerStats = [
            'count' => (int) $freelancerQuery->count(),
            'sum'   => (int) $freelancerQuery->sum('score'),
        ];
        $freelancerStats['avg'] = $freelancerStats['count'] > 0
            ? round($freelancerStats['sum'] / $freelancerStats['count'], 2)
            : 0;

        $clientStats = [
            'count' => (int) $clientQuery->count(),
            'sum'   => (int) $clientQuery->sum('score'),
        ];
        $clientStats['avg'] = $clientStats['count'] > 0
            ? round($clientStats['sum'] / $clientStats['count'], 2)
            : 0;

        return [$freelancerStats, $clientStats];
    }

    protected static function assignLevel(User $user, string $accountType, array $stats): void
    {
        $levels = ProjectLevel::forAccountType($accountType)
            ->orderBy('priority')
            ->get();

        if ($levels->isEmpty()) {
            return;
        }

        $completedProjects = $accountType === 'seller'
            ? self::completedProjectsForFreelancer($user)
            : self::completedProjectsForClient($user);

        $matchedLevel = $levels->filter(function (ProjectLevel $level) use ($completedProjects, $stats) {
            return $completedProjects >= $level->min_completed_projects
                && $stats['count'] >= $level->min_rating_count
                && $stats['avg'] >= $level->min_rating;
        })->last();

        if (!$matchedLevel) {
            $matchedLevel = $levels->first();
        }

        if ($accountType === 'seller' && $user->freelancer_project_level_id !== $matchedLevel->id) {
            $user->freelancer_project_level_id = $matchedLevel->id;
            $user->save();
        }

        if ($accountType === 'buyer' && $user->client_project_level_id !== $matchedLevel->id) {
            $user->client_project_level_id = $matchedLevel->id;
            $user->save();
        }
    }

    protected static function completedProjectsForFreelancer(User $user): int
    {
        return (int) Project::query()
            ->where('awarded_freelancer_id', $user->id)
            ->whereIn('status', ['completed', 'pending_final_review', 'closed'])
            ->count();
    }

    protected static function completedProjectsForClient(User $user): int
    {
        return (int) Project::query()
            ->where('user_id', $user->id)
            ->whereIn('status', ['completed', 'pending_final_review', 'closed'])
            ->count();
    }
}
