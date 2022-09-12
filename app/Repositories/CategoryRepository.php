<?php

namespace App\Repositories;
use App\Models\Category;

class CategoryRepository extends Repository
{
    /**
     * CategoryRepository constructor.
     *
     * @param Category $model
    */
   public function __construct(Category $model)
   {
       parent::__construct($model);
   }
}