<?php

namespace App\Http\Resources\Tracker;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
{
    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id'                  => $this->id,
            'client_id'           => $this->tracker_client_id,
            'client'              => new ClientResource($this->whenLoaded('client')),
            'project_id'          => $this->project_id,
            'name'                => $this->name,
            'reference_code'      => $this->reference_code,
            'description'         => $this->description,
            'default_hourly_rate' => $this->default_hourly_rate !== null ? (float) $this->default_hourly_rate : null,
            'weekly_limit_hours'  => $this->weekly_limit_hours !== null ? (float) $this->weekly_limit_hours : null,
            'is_active'           => (bool) $this->is_active,
            'starts_at'           => optional($this->starts_at)->toIso8601String(),
            'ends_at'             => optional($this->ends_at)->toIso8601String(),
            'archived_at'         => optional($this->archived_at)->toIso8601String(),
            'members'             => ProjectMemberResource::collection($this->whenLoaded('members')),
            'created_at'          => optional($this->created_at)->toIso8601String(),
            'updated_at'          => optional($this->updated_at)->toIso8601String(),
        ];
    }
}

