<?php

namespace App\Notifications\Hourly;

use App\Models\Payment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentReleasedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Payment $payment)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->payment->loadMissing(['invoice', 'contract', 'contract.project']);
        
        return (new MailMessage)
            ->subject(__('messages.t_payment_released'))
            ->greeting(__('messages.t_hello') . ' ' . $notifiable->username . '!')
            ->line(__('messages.t_payment_released_to_account', [
                'amount' => money($this->payment->freelancer_amount, $this->payment->currency_code, true)
            ]))
            ->line(__('messages.t_project') . ': ' . ($this->payment->contract->project->title ?? 'N/A'))
            ->line(__('messages.t_invoice') . ': #' . $this->payment->invoice_id)
            ->action(__('messages.t_view_earnings'), url('seller/earnings'))
            ->line(__('messages.t_thank_you_for_using_our_platform'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'payment_id' => $this->payment->id,
            'invoice_id' => $this->payment->invoice_id,
            'type' => 'payment_released',
            'amount' => $this->payment->freelancer_amount,
            'message' => __('messages.t_payment_released_to_account', [
                'amount' => money($this->payment->freelancer_amount, $this->payment->currency_code, true)
            ]),
        ];
    }
}

