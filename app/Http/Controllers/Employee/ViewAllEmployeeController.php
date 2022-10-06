<?php

namespace App\Http\Controllers\Employee;

use App\Enumerations\BookingStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\EmployeeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViewAllEmployeeController extends Controller
{
    /**
     * 
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ViewAllEmployeeController constructor
     * 
     * @return void
     */
    public function __construct(
        EmployeeService $employeeService,
        BookingService $bookingService
    )
    {
        // Authorize
        $this->middleware('can:view-all-employee')->only('index', 'show');

        $this->employeeService = $employeeService;
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
            'relations' => ['department', 'role']
        ];

        $employees = $this->employeeService->getBy($conditions, $options);
        
        return view('employees.index', [
            'employees' => $employees,
            'title' => 'All employees'
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
            $employee = $this->employeeService->find($id);

            $bookings = $this->bookingService->getBy([
                [
                    'column' => 'employee_id',
                    'value' => $employee->id
                ],
                [
                    'column' => 'status',
                    'value' => BookingStatus::ALLOCATED
                ]
            ]);
    
            $equipments = collect();
            foreach($bookings as $booking)
            {
                $equipments->add($booking->equipment);
            }

            $equipments = collect();
            foreach($bookings as $booking)
            {
                $equipments->add($booking->equipment);
            }
        }
        catch (ModelNotFoundException)
        {
            return back()->withErrors(['message' => 'Not found employee!']);
        }

        return view('employees.detail', [
            'employee' => $employee,
            'equipments' => $equipments
        ]);
    }
}
