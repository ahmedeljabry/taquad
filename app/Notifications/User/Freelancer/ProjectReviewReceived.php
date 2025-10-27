<?php

namespace App\Notifications\User\Freelancer;

use App\Models\Project;
use App\Models\ProjectReview;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class ProjectReviewReceived extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        protected Project $project,
        protected ProjectReview $review,
        protected User $reviewer
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

    /**
     * Get the mail representation of the notification.
     */
    public function toArray($notifiable): array
    {
        $ratingValue = $this->review->score ? number_format((float) $this->review->score, 1) : null;

        return [
            'type'        => 'project_review_received',
            'project_uid' => $this->project->uid,
            'project_id'  => $this->project->id,
            'project'     => $this->project->title,
            'review_uid'  => $this->review->uid,
            'rating'      => $ratingValue,
            'comment'     => $this->review->comment,
            'from'        => [
                'id'       => $this->reviewer->id,
                'username' => $this->reviewer->username,
                'fullname' => $this->reviewer->fullname,
            ],
            'action_url'  => url('seller/projects/milestones/' . $this->project->uid),
        ];
    }
}
