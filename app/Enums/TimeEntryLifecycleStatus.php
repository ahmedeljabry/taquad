<?php

namespace App\Enums;

enum TimeEntryLifecycleStatus: string
{
    case InProgress = 'in_progress';
    case InReview   = 'in_review';
    case Approved   = 'approved';
    case Rejected   = 'rejected';
    case Pending    = 'pending';
    case Available  = 'available';
    case Locked     = 'locked';
}
