<?php

namespace App\Domain\Enums;

enum StockTypeEnum: string
{
    case Inbound = 'inbound';
    case Production = 'production';
    case Sales = 'sales';
    case Adjustment = 'adjustment';
}
