<?php

namespace App\Http\Resources\Tracker;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'user_id'            => $this->user_id,
            'name'               => $this->name,
            'company_name'       => $this->company_name,
            'contact_email'      => $this->contact_email,
            'contact_phone'      => $this->contact_phone,
            'timezone'           => $this->timezone,
            'currency_code'      => $this->currency_code,
            'billing_preferences'=> $this->billing_preferences,
            'notes'              => $this->notes,
            'projects_count'     => $this->whenCounted('projects'),
            'created_at'         => optional($this->created_at)->toIso8601String(),
            'updated_at'         => optional($this->updated_at)->toIso8601String(),
        ];
    }
}

