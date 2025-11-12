<?php

namespace App\Actions\Hourly;

use App\Enums\DisputeStatus;
use App\Enums\InvoiceStatus;
use App\Events\Hourly\InvoiceDisputed;
use App\Models\Dispute;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class DisputeInvoiceAction
{
    /**
     * Create a dispute for an invoice
     *
     * @param  Invoice  $invoice
     * @param  int  $clientId
     * @param  string  $reason
     * @param  array{disputed_amount?: float, disputed_hours?: float, details?: string}  $details
     * @return Dispute
     */
    public function handle(Invoice $invoice, int $clientId, string $reason, array $details = []): Dispute
    {
        return DB::transaction(function () use ($invoice, $clientId, $reason, $details) {
            $invoice->loadMissing('contract');

            // Verify the client owns this invoice
            if ($invoice->contract->client_id !== $clientId) {
                throw new \InvalidArgumentException('You are not authorized to dispute this invoice.');
            }

            // Verify invoice can be disputed
            if (!in_array($invoice->status, [InvoiceStatus::Open, InvoiceStatus::Billed])) {
                throw new \InvalidArgumentException('This invoice cannot be disputed in its current state.');
            }

            // Create dispute
            $dispute = Dispute::create([
                'invoice_id' => $invoice->id,
                'contract_id' => $invoice->contract_id,
                'raised_by' => $clientId,
                'reason' => $reason,
                'disputed_amount' => $details['disputed_amount'] ?? $invoice->total_amount,
                'disputed_hours' => $details['disputed_hours'] ?? ($invoice->total_minutes / 60),
                'details' => $details['details'] ?? null,
                'status' => DisputeStatus::Open,
            ]);

            // Update invoice status
            $invoice->update(['status' => InvoiceStatus::Disputed]);

            // Dispatch event
            event(new InvoiceDisputed($invoice, $dispute));

            return $dispute;
        });
    }
}

