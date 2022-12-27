<?php

namespace App\Http\Controllers\Booking;

use App\Enumerations\BookingStatus;
use App\Enumerations\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use DateTime;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AllocateDeviceController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * AllocateDeviceController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        // Authorization
        $this->middleware('can:allocate-device')->only(['update']);

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
        try
        {
            $booking = $this->bookingService->find($id);
            $booking->status = BookingStatus::ALLOCATED;
            $booking->allocated_date = new DateTime();

            // $equipment = $booking->equipment;
            // $equipment->status = EquipmentStatus::ALLOCATED;

            $booking->update();
            // $equipment->update();

            return back()->with([
                'message' => "Device has been allocated!"
            ]);
        }
        catch(ModelNotFoundException)
        {
            return back()->withErrors(['message' => 'Not found booking!']);
        }
    }
}
