<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleRequest;
use App\Services\RoleService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class RoleController extends Controller
{
    /**
     * 
     * @var RoleService
     */
    private $roleService;

    /**
     * 
     * CategoryController constructor
     * 
     * @return void
     */
    public function __construct(
        RoleService $roleService
    )
    {
        // Authorize
        $this->middleware('can:view-role')->only('index', 'show');
        $this->middleware('can:create-role')->only('create', 'store');
        $this->middleware('can:update-role')->only('edit', 'update');
        $this->middleware('can:delete-role')->only('destroy');

        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleService->getAll();
        
        return view('roles.index', [
            'roles' => $roles
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        try
        {
            $validated = $request->validated();

            $this->roleService->create(array_merge($validated, [
                'slug' => strtolower(request('name'))
            ]));

            return to_route('role.index')->with([
                'message' => 'Create new role successfully'
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
            $role = $this->roleService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('role.index')->withErrors(['message' => 'Not found role!']);
        }
       

        return view('roles.detail', [
            'role' => $role
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
            $role = $this->roleService->find($id);
        }
        catch(ModelNotFoundException)
        {
            return to_route('role.index')->withErrors(['message' => 'Not found role!']);
        }

        return view('roles.edit', [
            'role' => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        try
        {
            $this->roleService->update($id, $request->validated());

            return to_route('role.index')->with([
                'message' => "Update role '$request->name' successfully"
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
            return to_route('role.index')->withErrors(['message' => 'Not found role!']);
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
            $this->roleService->delete($id);
        }
        catch(Exception)
        {
            return to_route('role.index')->withErrors(['message' => 'Can not delete role!']);
        }
        return to_route('role.index')->with([
            'message' => "Delete role successfully"
        ]);
    }
}
