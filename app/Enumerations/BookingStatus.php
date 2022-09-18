<?php

namespace App\Enumerations;

enum BookingStatus: int
{
    case PENDING = 1;
    case APPROVED = 2;
    case DISAPPROVED = 3;
    case ALLOCATED = 4;
    case RETURNED = 5;
    case OUTOFDATE = 6;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function description(): string
    {
        return match($this) 
        {
            BookingStatus::PENDING => 'Pending',
            BookingStatus::APPROVED => 'Approved',
            BookingStatus::DISAPPROVED => 'Disapproved',
            BookingStatus::ALLOCATED => 'Allocated',
            BookingStatus::RETURNED => 'Returned',
            BookingStatus::OUTOFDATE => 'Out of date',
        };
    }

    public function color(): string
    {
        return match($this) 
        {
            BookingStatus::PENDING => 'primary',
            BookingStatus::APPROVED => 'success',
            BookingStatus::DISAPPROVED => 'secondary',
            BookingStatus::ALLOCATED => 'info',
            BookingStatus::RETURNED => 'warning',
            BookingStatus::OUTOFDATE => 'danger',
        };
    }
}