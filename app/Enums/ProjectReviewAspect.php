<?php

namespace App\Enums;

enum ProjectReviewAspect: string
{
    case EXPERIENCE = 'experience';
    case COMMUNICATION = 'communication';
    case TIMELINESS = 'timeliness';
    case QUALITY = 'quality';
    case PROFESSIONALISM = 'professionalism';

    public function label(): string
    {
        return match ($this) {
            self::EXPERIENCE      => __('messages.t_review_aspect_experience'),
            self::COMMUNICATION   => __('messages.t_review_aspect_communication'),
            self::TIMELINESS      => __('messages.t_review_aspect_timeliness'),
            self::QUALITY         => __('messages.t_review_aspect_quality'),
            self::PROFESSIONALISM => __('messages.t_review_aspect_professionalism'),
        };
    }
}
