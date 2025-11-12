<?php

namespace App\Notifications\Hourly;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoiceReadyNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Invoice $invoice)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->invoice->loadMissing(['contract', 'contract.project']);
        
        return (new MailMessage)
            ->subject(__('messages.t_new_invoice_ready'))
            ->greeting(__('messages.t_hello') . ' ' . $notifiable->username . '!')
            ->line(__('messages.t_invoice_ready_for_review', [
                'project' => $this->invoice->contract->project->title ?? 'Project',
                'week' => $this->invoice->week_start_date->format('M d') . ' - ' . $this->invoice->week_end_date->format('M d, Y')
            ]))
            ->line(__('messages.t_total_hours') . ': ' . number_format($this->invoice->total_minutes / 60, 2))
            ->line(__('messages.t_total_amount') . ': ' . money($this->invoice->total_amount, $this->invoice->currency_code ?? 'USD', true))
            ->action(__('messages.t_review_invoice'), url('account/invoices/' . $this->invoice->id))
            ->line(__('messages.t_thank_you_for_using_our_platform'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'invoice_id' => $this->invoice->id,
            'contract_id' => $this->invoice->contract_id,
            'type' => 'invoice_ready',
            'amount' => $this->invoice->total_amount,
            'message' => __('messages.t_invoice_ready_for_review', [
                'project' => $this->invoice->contract->project->title ?? 'Project',
                'week' => $this->invoice->week_start_date->format('M d') . ' - ' . $this->invoice->week_end_date->format('M d, Y')
            ]),
        ];
    }
}

