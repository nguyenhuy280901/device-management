<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;

class EmployeeService extends Service
{
    /**
     * EmployeeService constructor
     * 
     * @param EmployeeRepository $repository
     */
    public function __construct(EmployeeRepository $repository)
    {
        parent::__construct($repository);
    }
}