<?php

namespace App\Actions\Hourly;

use App\Enums\InvoiceStatus;
use App\Events\Hourly\InvoiceReviewed;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class ReviewInvoiceAction
{
    /**
     * Mark invoice as reviewed by client
     *
     * @param  Invoice  $invoice
     * @param  int  $clientId
     * @param  bool  $approved
     * @param  string|null  $notes
     * @return Invoice
     */
    public function handle(Invoice $invoice, int $clientId, bool $approved, ?string $notes = null): Invoice
    {
        return DB::transaction(function () use ($invoice, $clientId, $approved, $notes) {
            $invoice->loadMissing('contract');

            // Verify the client owns this invoice
            if ($invoice->contract->client_id !== $clientId) {
                throw new \InvalidArgumentException('You are not authorized to review this invoice.');
            }

            // Verify invoice is in reviewable state
            if ($invoice->status !== InvoiceStatus::Open) {
                throw new \InvalidArgumentException('Only open invoices can be reviewed.');
            }

            // Update invoice
            $invoice->update([
                'status' => $approved ? InvoiceStatus::Billed : InvoiceStatus::Disputed,
                'reviewed_at' => now(),
                'reviewed_by' => $clientId,
                'review_notes' => $notes,
            ]);

            // Dispatch event
            event(new InvoiceReviewed($invoice, $approved, $notes));

            return $invoice->fresh();
        });
    }
}

