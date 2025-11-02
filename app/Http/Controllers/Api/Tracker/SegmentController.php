<?php

namespace App\Http\Controllers\Api\Tracker;

use App\Enums\ContractStatus;
use App\Enums\TimeEntryClientStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Tracker\SegmentBatchRequest;
use App\Models\Contract;
use App\Models\TimeEntry;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Notifications\User\Client\NewTrackedTimeEntry;

class SegmentController extends Controller
{
    public function store(SegmentBatchRequest $request): JsonResponse
    {
        $user    = $request->user();
        $payload = collect($request->validated()['segments']);
        $synced  = [];
        $errors  = [];

        DB::beginTransaction();

        try {
            foreach ($payload as $index => $segment) {
                $contract = Contract::query()
                    ->where('id', $segment['contract_id'])
                    ->where('freelancer_id', $user->id)
                    ->first();

                if (! $contract || $contract->status !== ContractStatus::Active) {
                    $errors[] = $this->buildError($index, 'contract_id', __('messages.t_contract_not_found_or_inactive'));
                    continue;
                }

                $start = CarbonImmutable::parse($segment['started_at']);
                $end   = CarbonImmutable::parse($segment['ended_at']);

                if ($end->lessThanOrEqualTo($start)) {
                    $errors[] = $this->buildError($index, 'ended_at', __('messages.t_end_time_must_be_after_start'));
                    continue;
                }

                if ($end->greaterThan(now()->addMinutes(5))) {
                    $errors[] = $this->buildError($index, 'ended_at', __('messages.t_time_entry_in_future'));
                    continue;
                }

                $minutes         = (int) ($segment['minutes'] ?? 0);
                $computedMinutes = (int) max(1, $start->diffInMinutes($end));

                if ($minutes !== $computedMinutes) {
                    $minutes = $computedMinutes;
                }

                $signature = $segment['signature'] ?? sprintf('%s-%s-%s', $contract->id, $user->id, $start->getTimestamp());

                $contract->loadMissing(['project', 'client']);

                $entry = TimeEntry::firstOrNew([
                    'contract_id' => $contract->id,
                    'user_id'     => $user->id,
                    'started_at'  => $start,
                ]);

                $isNewEntry = ! $entry->exists;

                $entry->ended_at             = $end;
                $entry->duration_minutes     = $minutes;
                $entry->activity_score       = Arr::get($segment, 'activity_score', 0);
                $entry->low_activity         = (bool) Arr::get($segment, 'low_activity', false);
                $entry->is_manual            = (bool) Arr::get($segment, 'is_manual', false);
                $entry->memo                 = Arr::get($segment, 'memo');
                $entry->signature            = $signature;
                $entry->synced_at            = now();
                $entry->created_from_tracker = true;

                if ($isNewEntry) {
                    $entry->client_status   = TimeEntryClientStatus::Pending;
                    $entry->has_screenshot  = false;
                }

                $entry->save();
                $synced[] = $entry->id;

                if ($isNewEntry) {
                    $client = $contract->client;
                    $project = $contract->project;

                    if ($client && $project) {
                        notification([
                            'user_id' => $client->id,
                            'text'    => 't_notification_tracker_pending',
                            'params'  => [
                                'project' => $project->title,
                            ],
                            'action'  => url('account/projects/options/tracker/' . $project->uid),
                        ]);

                        $client->notify(new NewTrackedTimeEntry($contract, $entry));
                    }
                }
            }

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            report($th);

            return response()->json([
                'message' => __('messages.t_unexpected_error_try_again'),
            ], 500);
        }

        return response()->json([
            'synced' => $synced,
            'errors' => $errors,
        ]);
    }

    private function buildError(int $index, string $field, string $message): array
    {
        return [
            'index'   => $index,
            'field'   => $field,
            'message' => $message,
        ];
    }
}
