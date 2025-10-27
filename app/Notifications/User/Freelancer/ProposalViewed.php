<?php

namespace App\Notifications\User\Freelancer;

use App\Models\Project;
use App\Models\ProjectBid;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ProposalViewed extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Project $project,
        protected ProjectBid $bid,
        protected User $viewer
    ) {
        $this->queue = 'notifications';
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    public function toArray($notifiable): array
    {
        return [
            'type'        => 'proposal_viewed',
            'project_uid' => $this->project->uid,
            'project_id'  => $this->project->id,
            'project'     => $this->project->title,
            'bid_uid'     => $this->bid->uid,
            'from'        => [
                'id'       => $this->viewer->id,
                'username' => $this->viewer->username,
                'fullname' => $this->viewer->fullname,
            ],
            'action_url'  => url('seller/projects/bids'),
        ];
    }
}
