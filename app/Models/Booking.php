<?php

namespace App\Models;

use App\Enumerations\BookingStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    protected $fillable = [
        'equipment_id', 'employee_id', 'content', 'booking_date', 'status',
        'alocated_date', 'return_intented_date', 'return_actual_date',
    ];

    protected $casts = [
        'booking_date'  => 'datetime:Y-m-d H:i:s',
        'alocated_date' => 'datetime:Y-m-d H:i:s',
        'return_intented_date' => 'datetime:Y-m-d H:i:s',
        'return_actual_date' => 'datetime:Y-m-d H:i:s',
    ];

    /**
     * Get the employee that the booking belongs to.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    /**
     * Get the employee that the booking belongs to.
     */
    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    /**
     * Get the booking's status
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function status(): Attribute
    {
        return Attribute::make(
            get: function($value) {
                return BookingStatus::from($value);
            },
            set: function(BookingStatus|string $status) {
                if($status instanceof BookingStatus)
                {
                    return $status->value;
                }

                return $status;
            }
        );
    }
}
