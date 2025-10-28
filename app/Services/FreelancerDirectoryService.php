<?php

namespace App\Services;

use App\DataTransferObjects\FreelancerFiltersData;
use App\Enums\FreelancerSortOption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class FreelancerDirectoryService
{
    public function paginate(FreelancerFiltersData $filters, int $perPage = 12): LengthAwarePaginator
    {
        $query = User::query()
            ->select([
                'id',
                'uid',
                'username',
                'fullname',
                'headline',
                'country_id',
                'freelancer_project_level_id',
                'project_rating_avg',
                'project_rating_count',
                'project_rating_sum',
                'last_activity',
                'created_at',
            ])
            ->with(['avatar', 'country', 'freelancerProjectLevel', 'skills' => fn ($q) => $q->orderByDesc('experience')])
            ->where('account_type', 'seller')
            ->whereIn('status', ['active', 'verified'])
            ->whereNull('deleted_at');

        $query->selectRaw("
            (
                (COALESCE(project_rating_avg, 0) * 12) +
                LEAST(COALESCE(project_rating_sum, 0), 500)
            ) as quality_score
        ");

        $query->when($filters->search, function (Builder $builder) use ($filters) {
            $searchTerm = $filters->search;
            $prefixTerm = $searchTerm . '%';
            $likeTerm   = '%' . $searchTerm . '%';

            $builder->where(function (Builder $nested) use ($filters) {
                $nested->where('username', 'LIKE', '%' . $filters->search . '%')
                    ->orWhere('fullname', 'LIKE', '%' . $filters->search . '%')
                    ->orWhere('headline', 'LIKE', '%' . $filters->search . '%')
                    ->orWhereExists(function ($sub) use ($filters) {
                        $sub->selectRaw(1)
                            ->from('user_skills')
                            ->whereColumn('user_skills.user_id', 'users.id')
                            ->where('user_skills.name', 'LIKE', '%' . $filters->search . '%');
                    });
            });

            $builder->selectRaw(
                "
                (
                    (CASE WHEN username LIKE ? THEN 180 ELSE 0 END) +
                    (CASE WHEN fullname LIKE ? THEN 160 ELSE 0 END) +
                    (CASE WHEN headline LIKE ? THEN 80 ELSE 0 END) +
                    LEAST(COALESCE(project_rating_avg, 0) * 12, 120)
                ) as relevance_score
                ",
                [$prefixTerm, $prefixTerm, $likeTerm]
            );
        });

        foreach ($filters->skills as $skillSlug) {
            $query->whereHas('skills', function (Builder $relation) use ($skillSlug) {
                $relation->where('slug', $skillSlug);
            });
        }

        $query->when($filters->countryId, fn (Builder $builder, int $countryId) => $builder->where('country_id', $countryId));

        $query->when($filters->levelId, fn (Builder $builder, int $levelId) => $builder->where('freelancer_project_level_id', $levelId));

        $query->when($filters->minRating(), fn (Builder $builder, float $rating) => $builder->where('project_rating_avg', '>=', $rating));

        if ($filters->onlineOnly) {
            $query->where('last_activity', '>=', Carbon::now()->subMinutes(10));
        }

        $this->applySort($query, $filters->sort, (bool) $filters->search);

        return $query
            ->paginate($perPage)
            ->withQueryString();
    }

    protected function applySort(Builder $builder, FreelancerSortOption $sort, bool $hasSearch): void
    {
        match ($sort) {
            FreelancerSortOption::TopRated => $builder
                ->orderByDesc('project_rating_avg')
                ->orderByDesc('last_activity')
                ->orderByDesc('quality_score'),

            FreelancerSortOption::MostReviewed => $builder
                ->orderByDesc('project_rating_avg')
                ->orderByDesc('last_activity')
                ->orderByDesc('quality_score'),

            FreelancerSortOption::RecentlyActive => $builder
                ->orderByDesc('last_activity')
                ->orderByDesc('project_rating_avg')
                ->orderByDesc('quality_score'),

            FreelancerSortOption::Newest => $builder
                ->orderByDesc('created_at')
                ->orderByDesc('quality_score'),

            FreelancerSortOption::Relevance => $builder
                ->when($hasSearch, function (Builder $query) {
                    $query->orderByDesc('relevance_score')
                        ->orderByDesc('quality_score')
                        ->orderByDesc('last_activity');
                }, function (Builder $query) {
                    $query->orderByDesc('quality_score')
                        ->orderByDesc('project_rating_avg')
                        ->orderByDesc('last_activity');
                }),
        };
    }
}
