<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\AuthorizationRequest;
use App\Services\PermissionService;
use App\Services\RoleService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AuthorizeController extends Controller
{
    /**
     * @var PermissonService
     */
    private $permissionService;

    /**
     * @var RoleService
     */
    private $roleService;

    /**
     * 
     * AuthorizeController constructor
     * 
     * @return void
     */
    public function __construct(
        PermissionService $permissionService,
        RoleService $roleService,
    )
    {
        // Authorization
        $this->middleware('can:authorize');

        $this->permissionService = $permissionService;
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = $this->permissionService->getAll();
        $roles = $this->roleService->getAll();

        return view('authorize.index', [
            'permissions' => $permissions,
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
            $permissions = $role->permissions;
            return response()->json($permissions);
        }
        catch(ModelNotFoundException)
        {
            return null;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AuthorizationRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AuthorizationRequest $request, $id)
    {
        try
        {
            $request->validated();

            $role = $this->roleService->find($id);
            $role->refreshPermissions($request->permissions ?? []);
            $role->refresh();

            $response = [
                "status" => "success",
                "message" => "Update permission successfully!",
                "data" => [
                    "role" => $role,
                    "permissions" => $role->permissions
                ]
            ];
        }
        catch(ModelNotFoundException)
        {
            $response = [
                "status" => "fail",
                "message" => "Not found role!",
                "data" => null
            ];
        }
        catch(ValidationException $ex)
        {
            $response = [
                "status" => "fail",
                "message" => $ex->getMessage(),
                "data" => null
            ];
        }

        return response()->json($response);
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
