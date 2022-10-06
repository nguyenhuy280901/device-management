<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use App\Services\EquipmentService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ViewAllEquipmentController extends Controller
{
    /**
     * 
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * 
     * ViewAllEquipmentController constructor
     * 
     * @return void
     */
    public function __construct(EquipmentService $equipmentService)
    {
        // Authorize
        $this->middleware('can:view-all-device')->only('index', 'show');

        $this->equipmentService = $equipmentService;
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
            'relations' => 'category'
        ];
        $equipments = $this->equipmentService->getBy($conditions, $options);
        
        return view('equipments.index', [
            'equipments' => $equipments,
            'title' => 'All devices'
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
            $equipment = $this->equipmentService->find($id);
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
