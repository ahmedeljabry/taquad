<?php

namespace App\Actions\Hourly;

use App\Models\Invoice;
use App\Models\Payment;

interface PaymentService
{
    public function charge(float $amount, array $meta = []): array; // returns ['status' => 'succeeded'|'failed', 'ref' => string]
}

class FakePaymentService implements PaymentService
{
    public function charge(float $amount, array $meta = []): array
    {
        return ['status' => 'succeeded', 'ref' => 'FAKE-'.uniqid()];
    }
}

class CaptureInvoicePaymentAction
{
    public function __construct(private PaymentService $payments = new FakePaymentService) {}

    public function handle(Invoice $invoice): Payment
    {
        $res = $this->payments->charge((float) $invoice->total_amount, ['invoice_id' => $invoice->id]);
        $payment = Payment::create([
            'invoice_id'   => $invoice->id,
            'amount'       => $invoice->total_amount,
            'provider'     => 'fake',
            'provider_ref' => $res['ref'] ?? null,
            'status'       => $res['status'] ?? 'failed',
        ]);

        if ($payment->status === 'succeeded') {
            $invoice->update(['status' => 'paid']);
        } else {
            $invoice->update(['status' => 'billed']);
        }

        return $payment;
    }
}

