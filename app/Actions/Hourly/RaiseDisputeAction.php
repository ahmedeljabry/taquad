<?php

namespace App\Actions\Hourly;

use App\Models\Dispute;

class RaiseDisputeAction
{
    public function handle(int $invoiceId, int $userId, string $raisedBy, string $reason): Dispute
    {
        // 'raisedBy' must be 'client' or 'freelancer'
        if (!in_array($raisedBy, ['client','freelancer'])) {
            abort(422, 'Invalid dispute raiser');
        }
        return Dispute::create([
            'invoice_id' => $invoiceId,
            'raised_by'  => $raisedBy,
            'reason'     => $reason,
            'status'     => 'open',
        ]);
    }
}

