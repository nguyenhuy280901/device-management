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
use Illuminate\Support\Facades\DB;
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
            // dd(request()->all());
            DB::beginTransaction();


            $validated = $request->validated();

            $equipments = $this->equipmentService->getBy([
                [
                    "column" => "id",
                    "value" => request("equipment_id")
                ]
            ]);

            $status = BookingStatus::PENDINGMANAGER;
            foreach($equipments as $equipment) {
                if($equipment->approve_level == ApproveLevel::DIRECTOR)
                {
                    $status = BookingStatus::PENDINGDIRECTOR;
                    break;
                }
            }

            $bookingID = DB::table('bookings')->insertGetId(array_merge($validated, [
                "employee_id" => Auth::id(),
                "status" => $status
            ]));

            $booking = $this->bookingService->find($bookingID);
            $quantities = request("quantity");

            foreach(request("equipment_id") as $key => $equipment_id) {
                DB::table('booking_details')->insert([
                    "booking_id" => $bookingID,
                    "equipment_id" => $equipment_id,
                    "quantity" => $quantities[$key]
                ]);
            }

            CreateBookingEvent::dispatch($booking);
            DB::commit();

            return to_route('my-booking.show', ['my_booking' => $booking->id])->with([
                'message' => 'Book device successfully!'
            ]);
        }
        catch(ValidationException $ex)
        {
            DB::rollBack();
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch(ModelNotFoundException)
        {
            DB::rollBack();
            return back()->withErrors(['message' => 'Not found equipment!']);
        }
    }
}
