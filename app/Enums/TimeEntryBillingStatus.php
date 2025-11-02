<?php

namespace App\Enums;

enum TimeEntryBillingStatus: string
{
    case Draft     = 'draft';
    case Hold      = 'hold';
    case Available = 'available';
    case Released  = 'released';
    case Refunded  = 'refunded';
}
