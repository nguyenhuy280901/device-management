<?php

namespace App\Repositories;

use App\Models\Role;

class RoleRepository extends Repository
{
    /**
     * RoleRepository constructor.
     *
     * @param Role $model
    */
   public function __construct(Role $model)
   {
       parent::__construct($model);
   }
}