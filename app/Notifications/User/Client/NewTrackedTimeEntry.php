<?php

namespace App\Notifications\User\Client;

use App\Models\Contract;
use App\Models\TimeEntry;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewTrackedTimeEntry extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Contract $contract,
        protected TimeEntry $entry
    ) {
        $this->queue = 'notifications';
    }

    public function via($notifiable): array
    {
        return ['mail'];
    }

    public function toMail($notifiable): MailMessage
    {
        $project = $this->contract->project;
        $minutes = (int) $this->entry->duration_minutes;
        $hours = round($minutes / 60, 2);

        return (new MailMessage())
            ->subject(
                __('messages.t_tracker_time_entry_pending_subject', [
                    'project' => $project?->title ?? __('messages.t_project'),
                ])
            )
            ->greeting(__('messages.t_hello_username', ['username' => $notifiable->username ?? $notifiable->fullname]))
            ->line(
                __('messages.t_tracker_time_entry_pending_line', [
                    'project' => $project?->title ?? __('messages.t_project'),
                    'minutes' => $minutes,
                    'hours'   => number_format($hours, 2),
                ])
            )
            ->line(__('messages.t_tracker_time_entry_pending_hint'))
            ->action(
                __('messages.t_review_tracked_hours'),
                url('account/projects/options/tracker/' . $project?->uid)
            );
    }
}
