<?php

namespace App\Enumerations;

enum EmployeeRole: int
{
    case ADMINISTRATOR = 1;
    case DIRECTOR = 2;
    case MANAGER = 3;
    case STAFF = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function description(): string
    {
        return match($this) 
        {
            EmployeeRole::ADMINISTRATOR => 'Administrator',
            EmployeeRole::DIRECTOR => 'Director',
            EmployeeRole::MANAGER => 'Manager',
            EmployeeRole::STAFF => 'Staff',
        };
    }
}