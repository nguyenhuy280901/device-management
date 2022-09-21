<?php

namespace App\Repositories;
use App\Models\Permission;

class PermissionRepository extends Repository
{
    /**
     * PermissionRepository constructor.
     *
     * @param Permission $model
    */
   public function __construct(Permission $model)
   {
       parent::__construct($model);
   }
}