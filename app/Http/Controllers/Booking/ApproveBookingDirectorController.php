<?php

namespace App\Http\Controllers\Booking;

use App\Enumerations\BookingStatus;
use App\Enumerations\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\ApproveBookingDirectorRequest;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class ApproveBookingDirectorController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ApproveBookingDirectorController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        // Authorization
        $this->middleware('can:approve-booking-director')->only(['update']);

        $this->bookingService = $bookingService;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Booking\ApproveBookingDirectorRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApproveBookingDirectorRequest $request, $id)
    {
        try
        {
            $request->validated();
            $booking = $this->bookingService->find($id);

            if(request('status') == BookingStatus::APPROVED->value)
            {
                // Approve booking
                $booking->status = BookingStatus::APPROVED;
                $booking->update();

                // // Update status of equipment
                // $equipment = $booking->equipment;
                // $equipment->status = EquipmentStatus::UNAVAILABLE;
                // $equipment->update();
                // // Disable other bookings of this equipment
                // $otherBookings = $this->bookingService->getBy([
                //     [
                //         'column' => 'equipment_id',
                //         'value' => $equipment->id
                //     ],
                //     [
                //         'column' => 'id',
                //         'operator' => '<>',
                //         'value' => $booking->id
                //     ]
                // ], ["columns" => "id"]);

                // $this->bookingService->update($otherBookings->toArray(), [
                //     'status' => BookingStatus::DISAPPROVED
                // ]);

                $message = 'Booking has been approved!';
            }
            else
            {
                $booking->status = BookingStatus::DISAPPROVED;
                $booking->update();

                $message = 'Booking has been disapproved!';
            }
            
            
            return back()->with([
                'message' => $message
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch(ModelNotFoundException)
        {
            return back()->withErrors(['message' => 'Not found booking!']);
        }
    }
}
