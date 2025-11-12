<?php

namespace App\Notifications\Hourly;

use App\Models\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContractActivatedNotification extends Notification implements ShouldQueue
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
        $this->contract->loadMissing(['project', 'client', 'freelancer']);
        
        return (new MailMessage)
            ->subject(__('messages.t_contract_activated'))
            ->greeting(__('messages.t_hello') . ' ' . $notifiable->username . '!')
            ->line(__('messages.t_contract_activated_for_project', [
                'project' => $this->contract->project->title
            ]))
            ->line(__('messages.t_hourly_rate') . ': ' . money($this->contract->hourly_rate, $this->contract->currency_code, true))
            ->action(__('messages.t_view_contract'), url('seller/contracts'))
            ->line(__('messages.t_thank_you_for_using_our_platform'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'type' => 'contract_activated',
            'message' => __('messages.t_contract_activated_for_project', [
                'project' => $this->contract->project->title ?? ''
            ]),
        ];
    }
}

