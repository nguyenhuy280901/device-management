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
     * Get list models with eager loading
     *
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function with($relations): Collection
    {
        return $this->model->with($relations)->get();
    }

    /**
     * Get list models by conditions
     *
     * @param  array  $conditions
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function where($conditions): Collection
    {
        return $this->model->where($conditions)->get();
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

    /**
     * 
     * Find a model by id
     * 
     * @param string $id
     * @return Model
     */
    public function find($id): Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * 
     * Update a model in database
     * 
     * @param string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool
    {
        return $this->model->find($id)->update($attributes);
    }

    /**
     * 
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null
    {
        return $this->model->find($id)->delete();
    }
}