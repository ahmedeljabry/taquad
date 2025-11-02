<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        $user = $this->user();

        if (! $user) {
            return false;
        }

        $ability = config('tracker.admin_required_ability', 'tracker:manage');

        if (method_exists($user, 'tokenCan') && $user->currentAccessToken()?->can($ability)) {
            return true;
        }

        return $user->can('manage tracker');
    }

    public function rules(): array
    {
        $project = $this->route('project') ?? $this->route('tracker_project');

        return [
            'tracker_client_id'  => ['sometimes', 'required', 'exists:tracker_clients,id'],
            'project_id'         => ['nullable', 'exists:projects,id'],
            'name'               => ['sometimes', 'required', 'string', 'max:255'],
            'reference_code'     => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('tracker_projects', 'reference_code')->ignore($project?->id),
            ],
            'description'        => ['nullable', 'string'],
            'default_hourly_rate'=> ['nullable', 'numeric', 'min:0'],
            'weekly_limit_hours' => ['nullable', 'numeric', 'min:0'],
            'is_active'          => ['nullable', 'boolean'],
            'starts_at'          => ['nullable', 'date'],
            'ends_at'            => ['nullable', 'date', 'after_or_equal:starts_at'],
        ];
    }
}
