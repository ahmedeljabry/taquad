<?php

namespace App\Services\Hourly;

use App\Enums\InvoiceStatus;
use App\Enums\TimeEntryBillingStatus;
use App\Enums\TimeEntryClientStatus;
use App\Enums\TimeEntryLifecycleStatus;
use App\Models\Contract;
use App\Models\Invoice;
use App\Models\TimeEntry;
use Carbon\CarbonImmutable;
use Illuminate\Support\Facades\DB;

class InvoiceService
{
    /**
     * Generate invoices for all active contracts for the given week
     *
     * @param  CarbonImmutable  $weekEnding
     * @return int  Number of invoices generated
     */
    public function generateWeeklyInvoices(CarbonImmutable $weekEnding): int
    {
        $weekStart = $weekEnding->startOfWeek();
        $weekEnd = $weekEnding->endOfWeek();

        return DB::transaction(function () use ($weekStart, $weekEnd) {
            $count = 0;
            
            $contracts = Contract::query()
                ->where('status', 'active')
                ->with(['client', 'freelancer', 'project'])
                ->get();

            foreach ($contracts as $contract) {
                // Get approved time entries for this week
                $entries = TimeEntry::query()
                    ->where('contract_id', $contract->id)
                    ->whereBetween('started_at', [$weekStart, $weekEnd])
                    ->where('client_status', TimeEntryClientStatus::Approved)
                    ->where('status', TimeEntryLifecycleStatus::Approved)
                    ->get();

                if ($entries->isEmpty()) {
                    continue;
                }

                $totalMinutes = $entries->sum('duration_minutes');
                $totalHours = $totalMinutes / 60;
                
                // Calculate amounts
                $subtotal = $totalHours * (float) $contract->hourly_rate;
                $platformFee = $subtotal * config('hourly.fees.platform_rate', 0.10);
                $taxAmount = ($subtotal - $platformFee) * config('hourly.fees.tax_rate', 0.00);
                $totalAmount = $subtotal;
                $freelancerAmount = $subtotal - $platformFee - $taxAmount;

                // Create or update invoice
                $invoice = Invoice::updateOrCreate(
                    [
                        'contract_id' => $contract->id,
                        'week_start_date' => $weekStart->toDateString(),
                        'week_end_date' => $weekEnd->toDateString(),
                    ],
                    [
                        'total_minutes' => $totalMinutes,
                        'total_amount' => round($totalAmount, 2),
                        'subtotal' => round($subtotal, 2),
                        'platform_fee' => round($platformFee, 2),
                        'tax_amount' => round($taxAmount, 2),
                        'freelancer_amount' => round($freelancerAmount, 2),
                        'status' => InvoiceStatus::Open,
                        'currency_code' => $contract->currency_code,
                    ]
                );

                // Link time entries to this invoice
                $entries->each(function ($entry) use ($invoice) {
                    $entry->update([
                        'invoice_id' => $invoice->id,
                        'billing_status' => TimeEntryBillingStatus::Hold,
                    ]);
                });

                $count++;
            }

            return $count;
        });
    }

    /**
     * Calculate invoice breakdown with all fees
     *
     * @param  Contract  $contract
     * @param  int  $totalMinutes
     * @return array{subtotal: float, platform_fee: float, tax_amount: float, total_amount: float, freelancer_amount: float}
     */
    public function calculateInvoiceAmounts(Contract $contract, int $totalMinutes): array
    {
        $totalHours = $totalMinutes / 60;
        $subtotal = $totalHours * (float) $contract->hourly_rate;
        
        $platformFee = $subtotal * config('hourly.fees.platform_rate', 0.10);
        $taxAmount = ($subtotal - $platformFee) * config('hourly.fees.tax_rate', 0.00);
        $totalAmount = $subtotal;
        $freelancerAmount = $subtotal - $platformFee - $taxAmount;

        return [
            'subtotal' => round($subtotal, 2),
            'platform_fee' => round($platformFee, 2),
            'tax_amount' => round($taxAmount, 2),
            'total_amount' => round($totalAmount, 2),
            'freelancer_amount' => round($freelancerAmount, 2),
        ];
    }

    /**
     * Get weekly invoice summary for a contract
     *
     * @param  Contract  $contract
     * @param  CarbonImmutable  $weekStart
     * @return array{total_hours: float, total_amount: float, approved_hours: float, pending_hours: float}
     */
    public function getWeeklySummary(Contract $contract, CarbonImmutable $weekStart): array
    {
        $weekEnd = $weekStart->endOfWeek();

        $entries = TimeEntry::query()
            ->where('contract_id', $contract->id)
            ->whereBetween('started_at', [$weekStart, $weekEnd])
            ->get();

        $approvedMinutes = $entries
            ->where('client_status', TimeEntryClientStatus::Approved)
            ->sum('duration_minutes');

        $pendingMinutes = $entries
            ->where('client_status', TimeEntryClientStatus::Pending)
            ->sum('duration_minutes');

        $totalMinutes = $entries->sum('duration_minutes');

        return [
            'total_hours' => round($totalMinutes / 60, 2),
            'approved_hours' => round($approvedMinutes / 60, 2),
            'pending_hours' => round($pendingMinutes / 60, 2),
            'total_amount' => round(($totalMinutes / 60) * (float) $contract->hourly_rate, 2),
            'approved_amount' => round(($approvedMinutes / 60) * (float) $contract->hourly_rate, 2),
        ];
    }
}

