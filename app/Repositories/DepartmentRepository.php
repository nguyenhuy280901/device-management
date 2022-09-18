<?php

namespace App\Repositories;
use App\Models\Department;

class DepartmentRepository extends Repository
{
    /**
     * DepartmentRepository constructor.
     *
     * @param Department $model
    */
   public function __construct(Department $model)
   {
       parent::__construct($model);
   }
}