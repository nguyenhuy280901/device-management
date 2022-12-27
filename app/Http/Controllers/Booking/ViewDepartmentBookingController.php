<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\EmployeeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ViewDepartmentBookingController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * 
     * ViewDepartmentBookingController constructor
     * 
     * @return void
     */
    public function __construct(
        BookingService $bookingService,
        EmployeeService $employeeService
    )
    {
        // Authorization
        $this->middleware('can:view-department-booking')->only(['index', 'show']);

        $this->bookingService = $bookingService;
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = $this->employeeService->getBy([
            [
                'column' => 'department_id',
                'value' => Auth::user()->department_id
            ]
        ], ["columns" => ["id"]]);

        $conditions = [
            [
                'column' => 'employee_id',
                'value' => $employees->toArray()
            ]
        ];

        $options = [
            "relations" => ['employee', 'details', 'details.equipment']
        ];

        $bookings = $this->bookingService->getBy($conditions, $options);

        return view('bookings.index', [
            'bookings' => $bookings,
            'title' => 'Department bookings'
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
            if($employee->department_id != Auth::user()->department_id)
            {
                abort(403);
            }

            return view('bookings.detail', [
                'booking' => $booking,
            ]);
        }
        catch(ModelNotFoundException)
        {
            return to_route('department-booking.index')->withErrors(['message' => 'Not found booking!']);
        }
    }
}
