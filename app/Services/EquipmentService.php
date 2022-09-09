<?php

namespace App\Services;

use App\Repositories\EquipmentRepository;

class EquipmentService extends Service
{
    /**
     * EquipmentService constructor
     * 
     * @param EquipmentRepository $repository
     */
    public function __construct(EquipmentRepository $repository)
    {
        parent::__construct($repository);
    }
}