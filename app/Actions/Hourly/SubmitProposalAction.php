<?php

namespace App\Actions\Hourly;

use App\Models\Proposal;

class SubmitProposalAction
{
    public function handle(int $projectId, int $freelancerId, float $hourlyRate, ?string $coverLetter = null): Proposal
    {
        return Proposal::create([
            'project_id'    => $projectId,
            'freelancer_id' => $freelancerId,
            'cover_letter'  => $coverLetter,
            'hourly_rate'   => $hourlyRate,
            'status'        => 'submitted',
        ]);
    }
}

