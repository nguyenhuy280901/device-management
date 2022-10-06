<?php

namespace App\Events;

use App\Enumerations\BookingStatus;
use App\Enumerations\EmployeeRole;
use App\Models\Booking;
use App\Models\Employee;
use App\Models\Equipment;
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
     * @return void
     */
    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
        $this->employee = $this->booking->employee;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $channels = [
            new PrivateChannel('booking-director')
        ];

        if($this->booking->status == BookingStatus::PENDINGMANAGER)
        {
            array_push($channels, new PrivateChannel('booking-manager.' . $this->employee->department_id));
        }

        return $channels;
    }
}
