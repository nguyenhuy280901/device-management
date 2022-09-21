<?php

namespace App\Services;

use App\Repositories\RoleRepository;

class RoleService extends Service
{
    /**
     * RoleService constructor
     * 
     * @param RoleRepository $repository
     */
    public function __construct(RoleRepository $repository)
    {
        parent::__construct($repository);
    }
}