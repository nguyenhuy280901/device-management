<?php

namespace App\Http\Controllers;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use App\Events\CreateBookingEvent;
use App\Services\EquipmentService;
use App\Services\CategoryService;
use App\Http\Requests\EquipmentRequest;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
     * @var CategoryService
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
        $equipments = $this->equipmentService->getWithRelations('category');
        
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
            $validated = $request->validated();

            $file = $this->uploadService->decodeImageBase64(request('image_json'));
            $this->equipmentService->create(array_merge($validated, ["image" => $file->getFilename()]));

            $this->uploadService->store("images/equipments", $file);

            return to_route('equipment.index')->with([
                'message' => 'Create new device successfully'
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
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
            $equipment = $this->equipmentService->find($id);
        }
        catch (ModelNotFoundException $ex)
        {
            return to_route('equipment.index')->withErrors(['message' => 'Not found device!']);
        }

        return view('equipments.detail', [
            'equipment' => $equipment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $equipment = $this->equipmentService->find($id);
        }
        catch (ModelNotFoundException $ex)
        {
            return to_route('equipment.index')->withErrors(['message' => 'Not found device!']);
        }
        
        $statuses = EquipmentStatus::cases();
        $approveLevels = ApproveLevel::cases();
        $categories = $this->categoryService->getAll();

        return view('equipments.edit', [
            'equipment' => $equipment,
            'statuses' => $statuses,
            'approveLevels' => $approveLevels,
            'categories' => $categories,
        ]);
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
        try
        {
            $validated = $request->validated();

            // Only save upload image when the user change the image of device
            if(request('image_change') == 1)
            {
                $file = $this->uploadService->decodeImageBase64(request('image_json'));
                $this->uploadService->store("images/equipments", $file);
                $validated = array_merge($validated, ["image" => $file->getFilename()]);
            }
            
            $this->equipmentService->update($id, $validated);

            return to_route('equipment.index')->with([
                'message' => "Update device '$request->name' successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch (ModelNotFoundException $ex)
        {
            return to_route('equipment.index')->withErrors(['message' => 'Not found device!']);
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
        try
        {
            $this->equipmentService->delete($id);
        }
        catch(Exception)
        {
            return to_route('equipment.index')->withErrors(['message' => 'Can not delete device!']);
        }

        return to_route('equipment.index')->with([
            'message' => "Delete device successfully"
        ]);
    }
}
