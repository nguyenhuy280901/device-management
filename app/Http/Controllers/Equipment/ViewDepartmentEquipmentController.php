<?php

namespace App\Http\Controllers\Equipment;

use App\Enumerations\BookingStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ViewDepartmentEquipmentController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ViewDepartmentEquipmentController constructor
     * 
     * @return void
     */
    public function __construct(BookingService $bookingService)
    {
        // Authorize
        $this->middleware('can:view-department-device')->only('index', 'show');

        $this->bookingService = $bookingService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Auth::user()->department->employees;
        $conditions = [
            [
                'column' => 'employee_id',
                'value' => $employees->pluck('id')->toArray()
            ],
            [
                'column' => 'status',
                'value' => BookingStatus::ALLOCATED
            ]
        ];

        $options = [
            'relations' => ['details', 'details.equipment', 'details.equipment.category']
        ];

        $bookings = $this->bookingService->getBy($conditions, $options);
        $details = collect();
        foreach($bookings as $booking)
        {
            foreach($booking->details as $item)
            {
                $details->add($item);
            }
        }
        
        return view('equipments.index', [
            'details' => $details,
            'title' => 'Department devices'
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
            $employees = Auth::user()->department->employees;
            $conditions = [
                [
                    'column' => 'equipment_id',
                    'value' => $id
                ],
                [
                    'column' => 'employee_id',
                    'value' => $employees->pluck('id')->toArray()
                ],
                [
                    'column' => 'status',
                    'value' => BookingStatus::ALLOCATED
                ]
            ];

            $options = [
                'relations' => ['details', 'details.equipment', 'details.equipment.category']
            ];

            $bookings = $this->bookingService->getBy($conditions, $options);

            if($bookings->count() === 0)
            {
                abort(403);
            }

            $equipment = $bookings->first()->equipment;
        }
        catch (ModelNotFoundException)
        {
            return back()->withErrors(['message' => 'Not found device!']);
        }

        return view('equipments.detail', [
            'equipment' => $equipment
        ]);
    }
}
