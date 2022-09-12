<?php

namespace App\Services;

use App\Repositories\CategoryRepository;

class CategoryService extends Service
{
    /**
     * CategoryService constructor
     * 
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        parent::__construct($repository);
    }
}