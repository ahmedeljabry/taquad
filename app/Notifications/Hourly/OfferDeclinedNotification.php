<?php

namespace App\Notifications\Hourly;

use App\Models\Contract;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OfferDeclinedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Contract $contract,
        public ?string $reason = null
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $this->contract->loadMissing(['project', 'freelancer']);
        
        $mail = (new MailMessage)
            ->subject(__('messages.t_offer_declined'))
            ->greeting(__('messages.t_hello') . ' ' . $notifiable->username . '!')
            ->line(__('messages.t_freelancer_declined_offer', [
                'freelancer' => $this->contract->freelancer->username ?? 'Freelancer',
                'project' => $this->contract->project->title
            ]));
        
        if ($this->reason) {
            $mail->line(__('messages.t_reason') . ': ' . $this->reason);
        }
        
        return $mail
            ->action(__('messages.t_view_project'), url('account/projects/' . $this->contract->project->uid))
            ->line(__('messages.t_thank_you_for_using_our_platform'));
    }

    public function toArray(object $notifiable): array
    {
        return [
            'contract_id' => $this->contract->id,
            'project_id' => $this->contract->project_id,
            'type' => 'offer_declined',
            'reason' => $this->reason,
            'message' => __('messages.t_freelancer_declined_offer', [
                'freelancer' => $this->contract->freelancer->username ?? 'Freelancer',
                'project' => $this->contract->project->title ?? ''
            ]),
        ];
    }
}

