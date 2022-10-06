<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
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
     * Get list of models
     * 
     * @param array|string $columns
     * @return Collection
     */
    public function get(array|string $columns): Collection
    {
        return $this->model->select($columns)->get();
    }

    /**
     * Begin querying the model.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder
    {
        return $this->model->query();
    }

    /**
     * Get list models with eager loading
     *
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function with($relations): Builder
    {
        return $this->model->with($relations);
    }

    /**
     * Querying a model by conditions
     *
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function where($conditions): Builder
    {
        return $this->model->where($conditions);
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
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null
    {
        return $this->model->find($id)->delete();
    }

    /**
     * Get the primary key for the model.
     * 
     * @return string
     */
    public function getKeyName(): string
    {
        return $this->model->getKeyName();
    }
}