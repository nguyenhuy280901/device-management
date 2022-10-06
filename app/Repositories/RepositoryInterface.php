<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    /**
     * Get list of models
     * 
     * @param array|string $columns
     * @return Collection
     */
    public function get(array|string $columns): Collection;

    /**
     * Begin querying the model.
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(): Builder;

    /**
     * Querying a model with eager loading.
     *
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function with($relations): Builder;

    /**
     * Querying a model by conditions
     *
     * @param array $conditions
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function where($conditions): Builder;
    
    /**
     * Store new model in database
     * 
     * @param $attributes
     * @return Model
     */
    public function create($attributes): Model;

    /**
     * Find a model by id
     * 
     * @param string $id
     * @return Model
     */
    public function find($id):Model;

    /**
     * Update a model in database
     * 
     * @param string $id
     * @param array $attributes
     * @return bool
     */
    public function update($id, $attributes): bool;

    /**
     * Remove the specified model from storage.
     * 
     * @param string $id
     * @return bool|null
     */
    public function delete($id): bool|null;

    /**
     * Get the primary key for the model.
     * 
     * @return string
     */
    public function getKeyName(): string;
}