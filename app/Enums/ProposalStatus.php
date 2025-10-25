<?php

namespace App\Enums;

enum ProposalStatus: string
{
    case Submitted   = 'submitted';
    case Shortlisted = 'shortlisted';
    case Rejected    = 'rejected';
    case Withdrawn   = 'withdrawn';
    case Accepted    = 'accepted';
}

