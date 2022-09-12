<?php

namespace App\Http\Controllers;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use App\Services\EquipmentService;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\EquipmentRequest;
use App\Services\UploadService;
use Exception;
use Illuminate\Validation\ValidationException;

class EquipmentController extends Controller
{
    /**
     * 
     * @var EquipmentService
     */
    private $equipmentService;

    /**
     * 
     * @var EquipmentService
     */
    private $categoryService;

    /**
     * 
     * @var UploadService
     */
    private $uploadService;

    /**
     * 
     * EquipmentController constructor
     * 
     * @return void
     */
    public function __construct(
        EquipmentService $equipmentService,
        CategoryService $categoryService,
        UploadService $uploadService
    )
    {
        $this->equipmentService = $equipmentService;
        $this->categoryService = $categoryService;
        $this->uploadService = $uploadService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipments = $this->equipmentService->getAll();
        
        return view('equipments.index', [
            'equipments' => $equipments,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = EquipmentStatus::cases();
        $approveLevels = ApproveLevel::cases();
        $categories = $this->categoryService->getAll();

        return view('equipments.add', [
            'statuses' => $statuses,
            'approveLevels' => $approveLevels,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EquipmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EquipmentRequest $request)
    {
        try
        {
            $validatedData = $request->validated();
            $image = $this->uploadService->storeBase64(request('image_json'), asset("images/equipments"));
            $this->equipmentService->create(array_merge($validatedData, ["image" => $image]));
        }
        catch(ValidationException|Exception $ex)
        {
            dd($ex);
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
        //
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
     * @param  \App\Http\Requests\EquipmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EquipmentRequest $request, $id)
    {
        //
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
