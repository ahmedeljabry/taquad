<?php

namespace App\DataTransferObjects;

use App\Enums\FreelancerSortOption;
use Illuminate\Support\Str;

final class FreelancerFiltersData
{
    public function __construct(
        public readonly ?string $search,
        public readonly array $skills,
        public readonly ?int $countryId,
        public readonly ?int $levelId,
        public readonly ?int $ratingFloor,
        public readonly bool $onlineOnly,
        public readonly FreelancerSortOption $sort,
    ) {
    }

    public static function from(array $input): self
    {
        $search = isset($input['search']) ? trim((string) $input['search']) : null;
        $search = $search !== '' ? clean($search) : null;

        $skills = collect(explode(',', (string) ($input['skills'] ?? '')))
            ->map(fn ($skill) => Str::slug(trim((string) $skill)))
            ->filter()
            ->unique()
            ->values()
            ->all();

        $countryId = isset($input['country']) && is_numeric($input['country'])
            ? (int) $input['country']
            : null;

        $levelId = isset($input['level']) && is_numeric($input['level'])
            ? (int) $input['level']
            : null;

        $ratingFloor = isset($input['rating']) && is_numeric($input['rating'])
            ? max(0, min(5, (int) $input['rating']))
            : null;

        $onlineOnly = filter_var($input['online'] ?? false, FILTER_VALIDATE_BOOL);

        $sort = FreelancerSortOption::tryFrom((string) ($input['sort'] ?? ''))
            ?? FreelancerSortOption::default();

        return new self(
            search: $search ?: null,
            skills: $skills,
            countryId: $countryId,
            levelId: $levelId,
            ratingFloor: $ratingFloor ?: null,
            onlineOnly: $onlineOnly,
            sort: $sort,
        );
    }

    public function minRating(): ?float
    {
        return $this->ratingFloor ? (float) $this->ratingFloor : null;
    }
}
