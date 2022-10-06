<?php

namespace App\Enumerations;

enum EquipmentStatus: int
{
    case AVAILABLE = 1;
    case UNAVAILABLE = 2;
    case ALLOCATED = 3;
    case REPAIRING = 4;
    case DAMAGED = 5;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function description(): string
    {
        return match($this) 
        {
            EquipmentStatus::AVAILABLE => 'Available',
            EquipmentStatus::UNAVAILABLE => 'Unavailable',
            EquipmentStatus::ALLOCATED => 'Allocated',
            EquipmentStatus::REPAIRING => 'Repairing',
            EquipmentStatus::DAMAGED => 'Damaged',
        };
    }

    public function color(): string
    {
        return match($this) 
        {
            EquipmentStatus::AVAILABLE => 'success',
            EquipmentStatus::UNAVAILABLE => 'secondary',
            EquipmentStatus::ALLOCATED => 'primary',
            EquipmentStatus::REPAIRING => 'warning',
            EquipmentStatus::DAMAGED => 'danger',
        };
    }
}