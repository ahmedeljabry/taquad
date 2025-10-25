<?php

namespace App\Enums;

enum InvoiceStatus: string
{
    case Open     = 'open';
    case Billed   = 'billed';
    case Paid     = 'paid';
    case Disputed = 'disputed';
}

