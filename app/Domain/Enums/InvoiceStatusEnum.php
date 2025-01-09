<?php

namespace App\Domain\Enums;

enum InvoiceStatusEnum: string
{
    case Unpaid = 'unpaid';
    case Paid = 'paid';
    case Overdue = 'overdue';
    case Cancelled = 'cancelled';
}
