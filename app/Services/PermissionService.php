<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService extends Service
{
    /**
     * PermissionService constructor
     * 
     * @param PermissionRepository $repository
     */
    public function __construct(PermissionRepository $repository)
    {
        parent::__construct($repository);
    }
}