<?php

namespace App\Enums;

enum TimeEntryClientStatus: string
{
    case Pending  = 'pending';
    case Approved = 'approved';
    case Rejected = 'rejected';
}
