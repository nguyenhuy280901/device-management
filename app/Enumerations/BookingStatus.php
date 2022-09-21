<?php

namespace App\Enumerations;

enum BookingStatus: int
{
    case PENDINGMANAGER = 1;
    case PENDINGDIRECTOR = 2;
    case APPROVED = 3;
    case DISAPPROVED = 4;
    case ALLOCATED = 5;
    case RETURNED = 6;
    case OUTOFDATE = 7;

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function description(): string
    {
        return match($this) 
        {
            BookingStatus::PENDINGMANAGER => 'Pending Manager',
            BookingStatus::PENDINGDIRECTOR => 'Pending Director',
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
            BookingStatus::PENDINGMANAGER => 'primary',
            BookingStatus::PENDINGDIRECTOR => 'primary',
            BookingStatus::APPROVED => 'success',
            BookingStatus::DISAPPROVED => 'secondary',
            BookingStatus::ALLOCATED => 'info',
            BookingStatus::RETURNED => 'warning',
            BookingStatus::OUTOFDATE => 'danger',
        };
    }
}