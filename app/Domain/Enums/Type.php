<?php

namespace App\Domain\Enums;

enum Type: string
{
    case Row = '0';
    case Product = '1';

    /**
     * Get the label for the category type.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::Row => 'Row',
            self::Product => 'Product',
        };
    }

    /**
     * Get all category types as an associative array of values and labels.
     *
     * @return array
     */
    public static function all(): array
    {
        return array_combine(
            array_map(fn($case) => $case->label(), self::cases()),
            array_map(fn($case) => $case->value, self::cases())
        );
    }
    public static function reverse(): array
    {
        return array_combine(
            array_map(fn($case) => $case->value, self::cases()),
            array_map(fn($case) => $case->label(), self::cases())

        );
    }
}
