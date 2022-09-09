<?php

namespace App\Enumerations;

enum ApproveLevel: int
{
    case MANAGER = 1;
    case DIRECTOR = 2;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}