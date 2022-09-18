<?php

namespace App\Repositories;

use App\Models\Employee;

class EmployeeRepository extends Repository
{
    /**
     * EmployeeRepository constructor.
     *
     * @param Employee $model
    */
   public function __construct(Employee $model)
   {
       parent::__construct($model);
   }
}