<?php

namespace App\Repositories;

use App\Models\Equipment;

class EquipmentRepository extends Repository
{
    /**
     * EquipmentRepository constructor.
     *
     * @param Equipment $model
    */
   public function __construct(Equipment $model)
   {
       parent::__construct($model);
   }
}