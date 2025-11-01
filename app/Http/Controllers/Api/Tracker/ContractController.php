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
            ->with(['project:id,title'])
            ->where('freelancer_id', $user->id)
            ->where('status', ContractStatus::Active)
            ->orderByDesc('created_at')
            ->get();

        $currency = $this->resolveCurrencyCode();

        $data = $contracts->map(fn (Contract $contract) => [
            'id'                   => $contract->id,
            'title'                => $contract->project?->title ?? __('messages.t_project'),
            'hourly_rate_cents'    => (int) round((float) $contract->hourly_rate * 100),
            'currency'             => $currency,
            'weekly_limit_minutes' => $this->convertWeeklyLimitToMinutes($contract->weekly_limit_hours),
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
            // ignore
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
