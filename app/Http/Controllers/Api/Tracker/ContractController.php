<?php

namespace App\Http\Controllers\Api\Tracker;

use App\Enums\ContractStatus;
use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ContractController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = $request->user();

        $contracts = Contract::query()
            ->with([
                'trackerProject:id,name,reference_code',
                'project:id,uid,pid,title',
            ])
            ->where('freelancer_id', $user->id)
            ->where('status', ContractStatus::Active->value)
            ->orderByDesc('created_at')
            ->get();

        $currency = $this->resolveCurrencyCode();

        $data = $contracts->map(fn (Contract $contract) => [
            'id'                   => $contract->id,
            'title'                => $contract->project?->title
                ?? $contract->trackerProject?->name
                ?? __('messages.t_project'),
            'hourly_rate_cents'    => (int) round((float) $contract->hourly_rate * 100),
            'currency'             => $contract->currency_code ?? $currency,
            'tracker_project_id'   => $contract->tracker_project_id,
            'project_uid'          => $contract->project?->uid,
            'project_pid'          => $contract->project?->pid,
            'timezone'             => $contract->timezone ?? config('app.timezone'),
            'weekly_cap_minutes'   => $this->convertWeeklyLimitToMinutes($contract->weekly_limit_hours),
            'allow_manual_time'    => (bool) $contract->allow_manual_time,
            'auto_approve_low_activity' => (bool) $contract->auto_approve_low_activity,
            'status'               => $contract->status->value,
        ]);

        return response()->json(['data' => $data]);
    }

    private function resolveCurrencyCode(): string
    {
        try {
            $settings = settings('currency');
            if ($settings && $settings->code) {
                return (string) $settings->code;
            }
        } catch (\Throwable $th) {
            error_log($th->getMessage());
        }

        return config('app.currency', 'USD');
    }

    private function convertWeeklyLimitToMinutes(?float $weeklyLimitHours): int
    {
        if ($weeklyLimitHours === null) {
            return 0;
        }

        return (int) round($weeklyLimitHours * 60);
    }
}
