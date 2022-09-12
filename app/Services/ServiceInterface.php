<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface ServiceInterface
{
    /**
     * 
     * Get list all of models
     * 
     * @return Collection
     */
    public function getAll();

    /**
     * 
     * Create new model
     * @param $attributes
     * @return Model
     */
    public function create($attributes):Model;
}