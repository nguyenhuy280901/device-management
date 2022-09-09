<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{

    /**
     * Get list all of models
     * 
     * @return Model
     */
    public function all(): Collection;

    /**
     * Store new model in database
     * 
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model;
}