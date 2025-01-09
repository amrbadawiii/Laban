<?php

namespace App\Domain\Enums;


enum QuotationStatusEnum: string
{
    case Draft = 'draft';
    case Sent = 'sent';
    case Accepted = 'accepted';
    case Rejected = 'rejected';
}
