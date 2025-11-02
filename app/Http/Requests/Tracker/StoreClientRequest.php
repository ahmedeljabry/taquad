<?php

namespace App\Http\Requests\Tracker;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            'user_id'           => ['nullable', 'exists:users,id'],
            'name'              => ['required', 'string', 'max:255'],
            'company_name'      => ['nullable', 'string', 'max:255'],
            'contact_email'     => ['required', 'email', 'max:255', 'unique:tracker_clients,contact_email'],
            'contact_phone'     => ['nullable', 'string', 'max:100'],
            'timezone'          => ['nullable', 'string', 'max:100'],
            'currency_code'     => ['nullable', 'string', 'size:3'],
            'billing_preferences' => ['nullable', 'array'],
            'notes'             => ['nullable', 'string'],
        ];
    }
}
