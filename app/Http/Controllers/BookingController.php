<?php

namespace App\Http\Controllers;

use App\Enumerations\BookingStatus;
use App\Enumerations\EquipmentStatus;
use App\Events\CreateBookingEvent;
use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Services\BookingService;
use App\Services\EmployeeService;
use App\Services\EquipmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * 
     * BookingController constructor
     * 
     * @return void
     */
    public function __construct(
        BookingService $bookingService,
        EquipmentService $equipmentService,
        EmployeeService $employeeService
    )
    {
        // Authorization
        $this->middleware('can:book-device')->only(['create', 'store']);
        $this->middleware('can:approve-booking-manager, approve-booking-direcctor')->only(['index', 'show', 'update']);

        $this->bookingService = $bookingService;
        $this->equipmentService = $equipmentService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = $this->bookingService->getWithRelations(['employee', 'equipment']);
        
        return view('bookings.index', [
            'bookings' => $bookings
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipments = $this->equipmentService->getByConditions([
            ['status', EquipmentStatus::AVAILABLE->value]
        ]);

        $bookingsStatus = BookingStatus::values();

        return view('bookings.add', [
            'equipments' => $equipments,
            'bookingsStatus' => $bookingsStatus
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBookingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBookingRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $booking = $this->bookingService->create(array_merge($validated, [
                "employee_id" => Auth::id(),
                "status" => BookingStatus::PENDINGMANAGER
            ]));

            CreateBookingEvent::dispatch($booking, Auth::user());

            return to_route('category.index')->with([
                'message' => 'Create new category successfully'
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
            return to_route('booking.add')->withErrors(['message' => 'Not found equipment!']);
        }
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
            return to_route('booking.index')->withErrors(['message' => 'Not found booking!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBookingRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBookingRequest $request, $id)
    {
        try
        {
            $this->categoryService->update($id, $request->validated());

            return back()->with([
                'message' => "Update booking successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch(ModelNotFoundException $ex)
        {
            return back()->withErrors(['message' => 'Not found booking!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
