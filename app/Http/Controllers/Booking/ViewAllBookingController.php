<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViewAllBookingController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ViewAllBookingController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        // Authorization
        $this->middleware('can:view-all-booking')->only(['index', 'show']);

        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conditions = array();
        $options = [
            "relations" => ['employee', 'equipment']
        ];

        $bookings = $this->bookingService->getBy($conditions, $options);

        return view('bookings.index', [
            'bookings' => $bookings,
            'title' => 'All bookings'
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

            return view('bookings.detail', [
                'booking' => $booking,
            ]);
        }
        catch(ModelNotFoundException)
        {
            return to_route('all-booking.index')->withErrors(['message' => 'Not found booking!']);
        }
    }
}
