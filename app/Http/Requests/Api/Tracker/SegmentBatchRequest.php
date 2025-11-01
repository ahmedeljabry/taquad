<?php

namespace App\Http\Requests\Api\Tracker;

use Illuminate\Foundation\Http\FormRequest;

class SegmentBatchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'segments'                             => ['required', 'array', 'min:1', 'max:50'],
            'segments.*.contract_id'               => ['required', 'integer', 'exists:contracts,id'],
            'segments.*.started_at'                => ['required', 'date'],
            'segments.*.ended_at'                  => ['required', 'date'],
            'segments.*.minutes'                   => ['required', 'integer', 'min:1', 'max:60'],
            'segments.*.activity_score'            => ['nullable', 'integer', 'min:0', 'max:100'],
            'segments.*.low_activity'              => ['nullable', 'boolean'],
            'segments.*.is_manual'                 => ['nullable', 'boolean'],
            'segments.*.memo'                      => ['nullable', 'string', 'max:500'],
            'segments.*.signature'                 => ['nullable', 'string', 'max:255'],
        ];
    }
}
