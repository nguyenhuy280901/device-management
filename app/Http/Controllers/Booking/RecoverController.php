<?php

namespace App\Http\Controllers\Booking;

use App\Enumerations\BookingStatus;
use App\Enumerations\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class RecoverController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * RecoverController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        // Authorization
        $this->middleware('can:recover-device')->only(['update']);

        $this->bookingService = $bookingService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bookings = $this->bookingService->getBy([
            [
                'column' => 'equipment_id',
                'value' => $id
            ],
            [
                'column' => 'status',
                'value' => BookingStatus::ALLOCATED
            ]
        ]);

        if($bookings->count() == 0)
        {
            return back()->withErrors(['message' => 'Not found booking!']);
        }

        $booking = $bookings->first();

        $booking->status = BookingStatus::RETURNED;
        $booking->return_actual_date = new DateTime();

        $equipment = $booking->equipment;
        $equipment->status = EquipmentStatus::AVAILABLE;

        $booking->update();
        $equipment->update();

        return back()->with([
            'message' => "Device has been recovered!"
        ]);
    }
}
