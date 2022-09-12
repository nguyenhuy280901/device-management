<?php

namespace App\Enumerations;

use App\Enumerations\EquipmentStatus as EnumerationsEquipmentStatus;

enum EquipmentStatus: int
{
    case AVAILABLE = 1;
    case ALLOCATED = 2;
    case REPAIRING = 3;
    case DAMAGED = 4;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function description(): string
    {
        return match($this) 
        {
            EquipmentStatus::AVAILABLE => 'Available',
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
            EquipmentStatus::ALLOCATED => 'primary',
            EquipmentStatus::REPAIRING => 'warning',
            EquipmentStatus::DAMAGED => 'danger',
        };
    }
}