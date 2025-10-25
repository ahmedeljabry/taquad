<?php

namespace App\Enums;

enum ProjectStatus: string
{
    case Draft       = 'draft';
    case Open        = 'open';
    case Closed      = 'closed';
    case InProgress  = 'in_progress';
    case Completed   = 'completed';
    case Cancelled   = 'cancelled';
    case Active     = 'active';
}

