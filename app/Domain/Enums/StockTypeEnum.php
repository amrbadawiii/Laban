<?php

namespace App\Domain\Enums;

enum StockTypeEnum: string
{
    case Production = 'production';
    case Sales = 'sales';
    case Adjustment = 'adjustment';
}
