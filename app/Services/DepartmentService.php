<?php

namespace App\Services;

use App\Repositories\DepartmentRepository;

class DepartmentService extends Service
{
    /**
     * DepartmentService constructor
     * 
     * @param DepartmentRepository $repository
     */
    public function __construct(DepartmentRepository $repository)
    {
        parent::__construct($repository);
    }
}