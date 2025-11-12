<?php

namespace App\Actions\Hourly;

use App\Enums\InvoiceStatus;
use App\Enums\TimeEntryBillingStatus;
use App\Events\Hourly\InvoicePaymentProcessed;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class ProcessInvoicePaymentAction
{
    /**
     * Process payment for an invoice
     *
     * @param  Invoice  $invoice
     * @param  int  $clientId
     * @param  array{payment_method_id?: string, transaction_id?: string, notes?: string}  $paymentDetails
     * @return Payment
     */
    public function handle(Invoice $invoice, int $clientId, array $paymentDetails = []): Payment
    {
        return DB::transaction(function () use ($invoice, $clientId, $paymentDetails) {
            $invoice->loadMissing(['contract', 'contract.client', 'contract.freelancer']);

            // Verify the client owns this invoice
            if ($invoice->contract->client_id !== $clientId) {
                throw new \InvalidArgumentException('You are not authorized to pay this invoice.');
            }

            // Verify invoice is billed
            if ($invoice->status !== InvoiceStatus::Billed) {
                throw new \InvalidArgumentException('Only billed invoices can be paid.');
            }

            // Create payment record
            $payment = Payment::create([
                'invoice_id' => $invoice->id,
                'contract_id' => $invoice->contract_id,
                'payer_id' => $clientId,
                'payee_id' => $invoice->contract->freelancer_id,
                'amount' => $invoice->total_amount,
                'platform_fee' => $invoice->platform_fee ?? 0,
                'freelancer_amount' => $invoice->freelancer_amount ?? $invoice->total_amount,
                'currency_code' => $invoice->currency_code ?? $invoice->contract->currency_code,
                'payment_method' => $paymentDetails['payment_method_id'] ?? 'default',
                'transaction_id' => $paymentDetails['transaction_id'] ?? null,
                'status' => 'completed',
                'paid_at' => now(),
                'notes' => $paymentDetails['notes'] ?? null,
            ]);

            // Update invoice status
            $invoice->update([
                'status' => InvoiceStatus::Paid,
                'paid_at' => now(),
            ]);

            // Update time entries billing status
            $invoice->contract->time_entries()
                ->where('invoice_id', $invoice->id)
                ->update([
                    'billing_status' => TimeEntryBillingStatus::Available,
                    'payout_available_at' => now()->addDays(config('hourly.billing.funds_release_days', 3)),
                ]);

            // Dispatch event
            event(new InvoicePaymentProcessed($invoice, $payment));

            return $payment;
        });
    }
}

