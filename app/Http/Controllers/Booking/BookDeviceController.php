<?php

namespace App\Http\Controllers\Booking;

use App\Enumerations\ApproveLevel;
use App\Enumerations\BookingStatus;
use App\Enumerations\EquipmentStatus;
use App\Events\CreateBookingEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Services\BookingService;
use App\Services\EquipmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookDeviceController extends Controller
{
    /**
     * 
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * BookDeviceController constructor
     * 
     * @return void
     */
    public function __construct(
        EquipmentService $equipmentService,
        BookingService $bookingService
    )
    {
        $this->equipmentService = $equipmentService;
        $this->bookingService = $bookingService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = $this->equipmentService->getBy([
            [
                'column' => 'status',
                'value' => EquipmentStatus::AVAILABLE->value
            ]
        ]);

        return view('bookings.add', [
            'equipments' => $equipments
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Booking\StoreBookingRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $equipment = $this->equipmentService->find($request->equipment_id);
            if($equipment->approve_level == ApproveLevel::MANAGER)
            {
                $status = BookingStatus::PENDINGMANAGER;
            }
            else
            {
                $status = BookingStatus::PENDINGDIRECTOR;
            }

            $booking = $this->bookingService->create(array_merge($validated, [
                "employee_id" => Auth::id(),
                "status" => $status
            ]));

            CreateBookingEvent::dispatch($booking);

            return to_route('my-booking.show', ['my_booking' => $booking->id])->with([
                'message' => 'Book device successfully!'
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
            return back()->withErrors(['message' => 'Not found equipment!']);
        }
    }
}
