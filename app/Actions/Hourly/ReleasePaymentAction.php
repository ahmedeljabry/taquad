<?php

namespace App\Actions\Hourly;

use App\Events\Hourly\PaymentReleased;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ReleasePaymentAction
{
    /**
     * Release payment to freelancer's wallet/account
     *
     * @param  Payment  $payment
     * @return Payment
     */
    public function handle(Payment $payment): Payment
    {
        return DB::transaction(function () use ($payment) {
            // Verify payment is in correct state
            if ($payment->status !== 'completed') {
                throw new \InvalidArgumentException('Only completed payments can be released.');
            }

            if ($payment->released_at) {
                throw new \InvalidArgumentException('This payment has already been released.');
            }

            $payment->loadMissing(['payee', 'invoice', 'contract']);

            // Add funds to freelancer's wallet/balance
            $freelancer = $payment->payee;
            if ($freelancer) {
                // Assuming there's a wallet or balance field
                $freelancer->increment('balance', $payment->freelancer_amount);
                
                // Create wallet transaction record if exists
                if (class_exists(\App\Models\WalletTransaction::class)) {
                    \App\Models\WalletTransaction::create([
                        'user_id' => $freelancer->id,
                        'amount' => $payment->freelancer_amount,
                        'type' => 'credit',
                        'description' => "Payment released for invoice #{$payment->invoice_id}",
                        'reference_type' => Payment::class,
                        'reference_id' => $payment->id,
                    ]);
                }
            }

            // Mark payment as released
            $payment->update([
                'released_at' => now(),
                'status' => 'released',
            ]);

            // Dispatch event
            event(new PaymentReleased($payment));

            return $payment->fresh();
        });
    }
}

