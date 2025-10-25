<?php

namespace App\Actions\Hourly;

use App\Enums\ProjectStatus;
use App\Enums\ProjectType;
use App\Models\Project;
use Illuminate\Support\Str;

class CreateProjectAction
{
    public function handle(int $clientId, string $title, string $description, int $categoryId, ?int $budgetMin = null, ?int $budgetMax = null): Project
    {
        $slug = Str::slug($title.'-'.Str::random(6));
        return Project::create([
            'uid'           => Str::random(20),
            'pid'           => (string) random_int(100000, 999999),
            'user_id'       => $clientId,
            'title'         => $title,
            'slug'          => $slug,
            'description'   => $description,
            'category_id'   => $categoryId,
            'budget_min'    => $budgetMin ?? 0,
            'budget_max'    => $budgetMax ?? 0,
            'budget_type'   => ProjectType::Hourly->value,
            'duration'      => 0,
            'status'        => ProjectStatus::Open->value,
        ]);
    }
}

