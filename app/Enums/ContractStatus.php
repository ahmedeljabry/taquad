<?php

namespace App\Enums;

enum ContractStatus: string
{
    case OfferSent = 'offer_sent';
    case Active    = 'active';
    case Paused    = 'paused';
    case Ended     = 'ended';
}

