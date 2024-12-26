<?php

namespace App\Domain\Enums;

enum UserType: string
{
    case Admin = '0';
    case User = '1';

    /**
     * Get the label for the category type.
     *
     * @return string
     */
    public function label(): string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::User => 'User',
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

    public static function reverse_array(): array
    {
        return array_map(
            fn($case) => [
                'id' => $case->value,
                'name' => $case->label(),
            ],
            self::cases()
        );
    }

}
