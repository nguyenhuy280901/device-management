<?php

namespace App\Services;

use App\Models\Booking;
use App\Repositories\BookingRepository;

class BookingService extends Service
{
    /**
     * BookingService constructor
     * 
     * @param BookingRepository $repository
     */
    public function __construct(BookingRepository $repository)
    {
        parent::__construct($repository);
    }
}