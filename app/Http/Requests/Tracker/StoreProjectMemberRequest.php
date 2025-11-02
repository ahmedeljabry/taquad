<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProjectMemberRequest extends FormRequest
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
            'user_id'            => ['required', 'exists:users,id'],
            'role'               => ['nullable', Rule::in(['manager', 'freelancer', 'viewer'])],
            'hourly_rate'        => ['nullable', 'numeric', 'min:0'],
            'weekly_limit_hours' => ['nullable', 'numeric', 'min:0'],
            'status'             => ['nullable', Rule::in(['pending', 'active', 'removed'])],
        ];
    }
}
