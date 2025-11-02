<?php

namespace App\Http\Resources\Tracker;

use App\Enums\ContractStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    /**
     * @param  Request  $request
     */
    public function toArray($request): array
    {
        return [
            'id'                        => $this->id,
            'tracker_project_id'        => $this->tracker_project_id,
            'tracker_project'           => new ProjectResource($this->whenLoaded('trackerProject')),
            'project'                   => $this->whenLoaded('project', function () {
                return [
                    'id'    => $this->project?->id,
                    'uid'   => $this->project?->uid,
                    'pid'   => $this->project?->pid,
                    'title' => $this->project?->title,
                ];
            }),
            'client'                    => $this->whenLoaded('client', function () {
                return [
                    'id'    => $this->client->id,
                    'name'  => $this->client->name ?? $this->client->username ?? '',
                    'email' => $this->client->email,
                ];
            }),
            'freelancer'                => $this->whenLoaded('freelancer', function () {
                return [
                    'id'    => $this->freelancer->id,
                    'name'  => $this->freelancer->name ?? $this->freelancer->username ?? '',
                    'email' => $this->freelancer->email,
                ];
            }),
            'client_id'                 => $this->client_id,
            'freelancer_id'             => $this->freelancer_id,
            'type'                      => $this->type,
            'status'                    => $this->status instanceof ContractStatus ? $this->status->value : $this->status,
            'hourly_rate'               => (float) $this->hourly_rate,
            'weekly_limit_hours'        => $this->weekly_limit_hours !== null ? (float) $this->weekly_limit_hours : null,
            'allow_manual_time'         => (bool) $this->allow_manual_time,
            'auto_approve_low_activity' => (bool) $this->auto_approve_low_activity,
            'currency_code'             => $this->currency_code,
            'timezone'                  => $this->timezone,
            'starts_at'                 => optional($this->starts_at)->toIso8601String(),
            'ends_at'                   => optional($this->ends_at)->toIso8601String(),
            'archived_at'               => optional($this->archived_at)->toIso8601String(),
            'notes'                     => $this->notes,
            'created_at'                => optional($this->created_at)->toIso8601String(),
            'updated_at'                => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
