<?php

namespace App\Http\Controllers\Equipment;

use App\Enumerations\BookingStatus;
use App\Http\Controllers\Controller;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;

class ViewAlocatedEquipmentController extends Controller
{
    /**
     * 
     * @var BookingService
     */
    private $bookingService;

    /**
     * 
     * ViewAlocatedEquipmentController constructor
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
            ],
            [
                'column' => 'status',
                'value' => BookingStatus::ALLOCATED
            ]
        ];

        $options = [
            'relations' => ['equipment', 'equipment.category']
        ];

        $bookings = $this->bookingService->getBy($conditions, $options);

        $equipments = collect();
        foreach($bookings as $booking)
        {
            $equipments->add($booking->equipment);
        }

        return view('equipments.index', [
            'equipments' => $equipments,
            'title' => 'My devices'
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
            $conditions = [
                [
                    'column' => 'equipment_id',
                    'value' => $id
                ],
                [
                    'column' => 'employee_id',
                    'value' => Auth::id()
                ],
                [
                    'column' => 'status',
                    'value' => BookingStatus::ALLOCATED
                ]
            ];

            $options = [
                'relations' => ['equipment', 'equipment.category']
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
