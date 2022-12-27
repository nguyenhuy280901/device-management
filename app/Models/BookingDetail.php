<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDetail extends Model
{
    use HasFactory;

    /**
     * Get the employee that the booking belongs to.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }
}
