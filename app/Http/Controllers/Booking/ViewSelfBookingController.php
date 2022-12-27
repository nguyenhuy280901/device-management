<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ViewSelfBookingController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ViewSelfBookingController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = [
            [
                'column' => 'employee_id',
                'value' => Auth::id()
            ]
        ];

        $options = [
            "relations" => ['employee', 'details', 'details.equipment']
        ];

        $bookings = $this->bookingService->getBy($conditions, $options);

        return view('bookings.index', [
            'bookings' => $bookings,
            'title' => 'My bookings'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {
            $booking = $this->bookingService->find($id);
            $employee = $booking->employee;
            
            if($employee->id != Auth::id())
            {
                abort(403);
            }

            return view('bookings.detail', [
                'booking' => $booking,
            ]);
        }
        catch(ModelNotFoundException)
        {
            return to_route('my-booking.index')->withErrors(['message' => 'Not found booking!']);
        }
    }
}
