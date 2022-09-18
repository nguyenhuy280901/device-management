<?php

namespace App\Repositories;
use App\Models\Booking;

class BookingRepository extends Repository
{
    /**
     * BookingRepository constructor.
     *
     * @param Booking $model
    */
   public function __construct(Booking $model)
   {
       parent::__construct($model);
   }
}