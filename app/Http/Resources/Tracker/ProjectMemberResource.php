<?php

namespace App\Http\Resources\Tracker;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectMemberResource extends JsonResource
{
    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id'                 => $this->id,
            'project_id'         => $this->tracker_project_id,
            'user_id'            => $this->user_id,
            'role'               => $this->role,
            'hourly_rate'        => $this->hourly_rate !== null ? (float) $this->hourly_rate : null,
            'weekly_limit_hours' => $this->weekly_limit_hours !== null ? (float) $this->weekly_limit_hours : null,
            'status'             => $this->status,
            'user'               => $this->whenLoaded('user', function () {
                return [
                    'id'    => $this->user->id,
                    'name'  => $this->user->name ?? $this->user->username ?? '',
                    'email' => $this->user->email,
                ];
            }),
            'invited_at'         => optional($this->invited_at)->toIso8601String(),
            'joined_at'          => optional($this->joined_at)->toIso8601String(),
            'created_at'         => optional($this->created_at)->toIso8601String(),
            'updated_at'         => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
