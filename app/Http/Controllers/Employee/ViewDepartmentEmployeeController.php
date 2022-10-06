<?php

namespace App\Http\Controllers\Employee;

use App\Enumerations\BookingStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;

class ViewDepartmentEmployeeController extends Controller
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
     * ViewDepartmentEmployeeController constructor
     * 
     * @return void
     */
    public function __construct(
        EmployeeService $employeeService,
        BookingService $bookingService
    )
    {
        // Authorize
        $this->middleware('can:view-department-employee')->only('index', 'show');

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
        $conditions = [
            [
                'column' => 'department_id',
                'value' => Auth::user()->department_id
            ]
        ];
        $options = [
            'relations' => ['department', 'role']
        ];

        $employees = $this->employeeService->getBy($conditions, $options);
        
        return view('employees.index', [
            'employees' => $employees,
            'title' => 'Department employees'
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
        $conditions = [
            [
                'column' => 'id',
                'value' => $id
            ],
            [
                'column' => 'department_id',
                'value' => Auth::user()->department_id
            ]
        ];
        $options = [
            'relations' => ['department', 'role']
        ];

        $employees = $this->employeeService->getBy($conditions, $options);

        if($employees->count() == 0)
        {
            abort(403);
        }

        $employee = $employees->first();

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

        return view('employees.detail', [
            'employee' => $employee,
            'equipments' => $equipments,
        ]);
    }
}
