<?php

namespace App\Notifications\Hourly;

use App\Models\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferSentNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Contract $contract)
    {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->contract->loadMissing(['project', 'client']);
        
        return (new MailMessage)
            ->subject(__('messages.t_new_contract_offer'))
            ->greeting(__('messages.t_hello') . ' ' . $notifiable->username . '!')
            ->line(__('messages.t_you_received_offer_for_project', [
                'project' => $this->contract->project->title
            ]))
            ->line(__('messages.t_hourly_rate') . ': ' . money($this->contract->hourly_rate, $this->contract->currency_code, true))
            ->line(__('messages.t_weekly_limit') . ': ' . $this->contract->weekly_limit_hours . ' ' . __('messages.t_hours'))
            ->action(__('messages.t_view_offer'), url('seller/contracts/' . $this->contract->id))
            ->line(__('messages.t_thank_you_for_using_our_platform'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'type' => 'offer_sent',
            'message' => __('messages.t_you_received_offer_for_project', [
                'project' => $this->contract->project->title ?? ''
            ]),
        ];
    }
}

