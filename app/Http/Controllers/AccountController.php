<?php

namespace App\Http\Controllers;

use App\Services\BookingService;
use App\Services\EmployeeService;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * 
     * @var EmployeeService
     */
    private $employeeService;

    /**
     * 
     * AccountController constructor
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
        $employee = $this->employeeService->find(Auth::id());

        return view('accounts.index', [
            'employee' => $employee
        ]);
    }
}
