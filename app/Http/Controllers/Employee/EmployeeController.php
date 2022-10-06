<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\DepartmentService;
use App\Services\EmployeeService;
use App\Services\RoleService;
use App\Services\UploadService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    /**
     * 
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * 
     * @var DepartmentService
     */
    private $departmentService;

    /**
     * 
     * @var RoleService
     */
    private $roleService;

    /**
     * 
     * @var UploadService
     */
    private $uploadService;

    /**
     * 
     * EmployeeController constructor
     * 
     * @return void
     */
    public function __construct(
        EmployeeService $employeeService,
        DepartmentService $departmentService,
        UploadService $uploadService,
        RoleService $roleService
    )
    {
        // Authorize
        $this->middleware('can:create-employee')->only('create', 'store');
        $this->middleware('can:update-employee')->only('edit', 'update');
        $this->middleware('can:delete-employee')->only('destroy');

        $this->employeeService = $employeeService;
        $this->departmentService = $departmentService;
        $this->uploadService = $uploadService;
        $this->roleService = $roleService;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = $this->departmentService->getAll();
        $roles = $this->roleService->getAll();

        return view('employees.add', [
            'departments' => $departments,
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployeeRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $file = $this->uploadService->decodeImageBase64(request('image_json'));
            $this->employeeService->create(
                array_merge($validated, [
                    "image" => $file->getFilename(),
                    "password" => bcrypt(request()->password)
                ])
            );
            $this->uploadService->store("images/employees", $file);

            if(Gate::allows('view-all-employee'))
            {
                $redirectRoute =  'all-employee.index';
            }
            else if(Gate::allows('view-department-employee'))
            {
                $redirectRoute =  'department-employee.index';
            }
            else
            {
                $redirectRoute =  url()->previous();
            }

            return to_route($redirectRoute)->with([
                'message' => 'Create new employee successfully'
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $employee = $this->employeeService->find($id);
        }
        catch (ModelNotFoundException)
        {
            return to_route('employee.index')->withErrors(['message' => 'Not found employee!']);
        }
        
        $departments = $this->departmentService->getAll();
        $roles = $this->roleService->getAll();

        return view('employees.edit', [
            'employee' => $employee,
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, $id)
    {
        try
        {
            $validated = $request->validated();

            // Only save upload image when the user change the image of device
            if(request('image_change') == 1)
            {
                $file = $this->uploadService->decodeImageBase64(request('image_json'));
                $this->uploadService->store("images/employees", $file);
                $validated = array_merge($validated, ["image" => $file->getFilename()]);
            }
            
            $this->employeeService->update($id, $validated);

            if(Gate::allows('view-all-employee'))
            {
                $redirectRoute =  'all-employee.index';
            }
            else if(Gate::allows('view-department-employee'))
            {
                $redirectRoute =  'department-employee.index';
            }
            else
            {
                $redirectRoute =  url()->previous();
            }

            return to_route($redirectRoute)->with([
                'message' => "Update employee '$request->fullname' successfully"
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
            return back()->withErrors(['message' => 'Not found employee!']);
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
            $this->employeeService->delete($id);
        }
        catch(Exception)
        {
            return back()->withErrors(['message' => 'Can not delete employee!']);
        }

        if(Gate::allows('view-all-employee'))
        {
            $redirectRoute =  'all-employee.index';
        }
        else if(Gate::allows('view-department-employee'))
        {
            $redirectRoute =  'department-employee.index';
        }
        else
        {
            $redirectRoute =  url()->previous();
        }

        return to_route($redirectRoute)->with([
            'message' => "Delete employee successfully"
        ]);
    }
}
