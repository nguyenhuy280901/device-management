<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    /**
     * 
     * @var DepartmentService
     */
    private $departmentService;

    /**
     * 
     * DepartmentController constructor
     * 
     * @return void
     */
    public function __construct(
        DepartmentService $departmentService
    )
    {
        // Authorize
        $this->middleware('can:view-department')->only('index', 'show');
        $this->middleware('can:create-department')->only('create', 'store');
        $this->middleware('can:update-department')->only('edit', 'update');
        $this->middleware('can:delete-department')->only('destroy');

        $this->departmentService = $departmentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = $this->departmentService->getAll();
        
        return view('departments.index', [
            'departments' => $departments
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departments.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $this->departmentService->create($validated);

            return to_route('department.index')->with([
                'message' => 'Create new department successfully'
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
            $department = $this->departmentService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('department.index')->withErrors(['message' => 'Not found department!']);
        }
       
        return view('departments.detail', [
            'department' => $department
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
            $department = $this->departmentService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('department.index')->withErrors(['message' => 'Not found department!']);
        }

        return view('departments.edit', [
            'department' => $department
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        try
        {
            $this->departmentService->update($id, $request->validated());

            return to_route('department.index')->with([
                'message' => "Update department '$request->name' successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
        catch(ModelNotFoundException)
        {
            return to_route('department.index')->withErrors(['message' => 'Not found department!']);
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
            $this->departmentService->delete($id);
        }
        catch(Exception)
        {
            return to_route('department.index')->withErrors(['message' => 'Can not delete department!']);
        }
        return to_route('department.index')->with([
            'message' => "Delete department successfully"
        ]);
    }
}
