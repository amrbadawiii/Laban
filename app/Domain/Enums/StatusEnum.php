<?php

namespace App\Domain\Enums;

enum StatusEnum: string
{
    case Pending = 'pending';
    case Completed = 'completed';
    case InProgress = 'in_progress';
    case Cancelled = 'cancelled';
}
