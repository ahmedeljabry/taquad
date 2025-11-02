<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreContractRequest extends FormRequest
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
        return [
            'tracker_project_id' => ['required', 'exists:tracker_projects,id'],
            'client_id'          => ['required', 'exists:users,id'],
            'freelancer_id'      => ['required', 'different:client_id', 'exists:users,id'],
            'type'               => ['nullable', Rule::in(['hourly', 'fixed'])],
            'status'             => ['nullable', Rule::in(['offer_sent', 'active', 'paused', 'ended'])],
            'hourly_rate'        => ['required', 'numeric', 'min:0'],
            'weekly_limit_hours' => ['nullable', 'numeric', 'min:0'],
            'allow_manual_time'  => ['nullable', 'boolean'],
            'auto_approve_low_activity' => ['nullable', 'boolean'],
            'currency_code'      => ['nullable', 'string', 'size:3'],
            'timezone'           => ['nullable', 'string', 'max:100'],
            'starts_at'          => ['nullable', 'date'],
            'ends_at'            => ['nullable', 'date', 'after_or_equal:starts_at'],
            'notes'              => ['nullable', 'string'],
        ];
    }
}
