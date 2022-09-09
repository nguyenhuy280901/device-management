<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Repository implements RepositoryInterface
{
    /**
     * 
     * @var Model
     */
    private Model $model;

    /**
     * 
     * Reposiroty constructor
     * 
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get list all of models
     * 
     * @return Model
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * Store new model in database
     * 
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model
    {
        return $this->model->create($attributes);
    }
}