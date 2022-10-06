<?php

namespace App\Http\Controllers\Equipment;

use App\Enumerations\ApproveLevel;
use App\Enumerations\EquipmentStatus;
use App\Http\Controllers\Controller;
use App\Services\EquipmentService;
use App\Services\CategoryService;
use App\Http\Requests\EquipmentRequest;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
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
        // Authorize
        $this->middleware('can:create-device')->only('create', 'store');
        $this->middleware('can:update-device')->only('edit', 'update');
        $this->middleware('can:delete-device')->only('destroy');

        $this->equipmentService = $equipmentService;
        $this->categoryService = $categoryService;
        $this->uploadService = $uploadService;
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

            if(Gate::allows('view-all-device'))
            {
                $redirectRoute =  'all-equipment.index';
            }
            else if(Gate::allows('view-department-device'))
            {
                $redirectRoute =  'department-equipment.index';
            }
            else
            {
                $redirectRoute =  'my-equipment.index';
            }

            return to_route($redirectRoute)->with([
                'message' => 'Create new device successfully'
            ]);
        }
        catch(ValidationException $ex)
        {
            $file = $this->uploadService->decodeImageBase64(request('image_json'));
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
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
        try
        {
            $equipment = $this->equipmentService->find($id);
        }
        catch (ModelNotFoundException)
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

            if(Gate::allows('view-all-device'))
            {
                $redirectRoute =  'all-equipment.index';
            }
            else if(Gate::allows('view-department-device'))
            {
                $redirectRoute =  'department-equipment.index';
            }
            else
            {
                $redirectRoute =  'my-equipment.index';
            }

            return to_route($redirectRoute)->with([
                'message' => "Update device '$request->name' successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch (ModelNotFoundException)
        {
            return back()->withErrors(['message' => 'Not found device!']);
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

        if(Gate::allows('view-all-device'))
        {
            $redirectRoute =  'all-equipment.index';
        }
        else if(Gate::allows('view-department-device'))
        {
            $redirectRoute =  'department-equipment.index';
        }
        else
        {
            $redirectRoute =  'my-equipment.index';
        }

        return to_route($redirectRoute)->with([
            'message' => "Delete device successfully"
        ]);
    }
}
