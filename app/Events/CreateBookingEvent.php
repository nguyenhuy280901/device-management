<?php

namespace App\Events;

use App\Enumerations\EmployeeRole;
use App\Models\Booking;
use App\Models\Employee;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateBookingEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Booking $booking;
    public Employee $employee;

    /**
     * Create a new event instance.
     *
     * @param Booking $booking
     * @param Employee $employee
     * @return void
     */
    public function __construct(Booking $booking, Employee $employee)
    {
        $this->booking = $booking;
        $this->employee = $employee;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('booking-manager.' . $this->booking->employee->department_id);
    }
}
