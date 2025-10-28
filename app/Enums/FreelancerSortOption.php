<?php

namespace App\Enums;

enum FreelancerSortOption: string
{
    case Relevance       = 'relevance';
    case TopRated        = 'top_rated';
    case MostReviewed    = 'most_reviewed';
    case RecentlyActive  = 'recently_active';
    case Newest          = 'newest';

    public static function default(): self
    {
        return self::Relevance;
    }

    public static function options(): array
    {
        return [
            self::Relevance,
            self::TopRated,
            self::MostReviewed,
            self::RecentlyActive,
            self::Newest,
        ];
    }

    public function label(): string
    {
        return match ($this) {
            self::Relevance      => __('messages.t_freelancers_sort_relevance'),
            self::TopRated       => __('messages.t_freelancers_sort_top_rated'),
            self::MostReviewed   => __('messages.t_freelancers_sort_most_reviewed'),
            self::RecentlyActive => __('messages.t_freelancers_sort_recently_active'),
            self::Newest         => __('messages.t_freelancers_sort_newest'),
        };
    }
}
