<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class ChangePasswordController extends Controller
{
    private $employeeService;

    /**
     * 
     * AuthorizeController constructor
     * 
     * @return void
     */
    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.change-password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ChangePasswordRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ChangePasswordRequest $request, $id)
    {
        try
        {
            $request->validated();

            $this->employeeService->update(Auth::id(), [
                'password' => bcrypt(request('new_password'))
            ]);

            return to_route('my-information.index')->with([
                'message' => "Change password successfully"
            ]);
        }
        catch(ValidationException $ex)
        {
            return back()->withErrors([
                'message' => $ex->getMessage()
            ])->withInput();
        }
    }
}
